<?php

namespace App\Services\Rabbit;

use App\Services\BaseService;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class MessagesBaseService extends BaseService
{
    /** @var AMQPStreamConnection $connection */
    public AMQPStreamConnection $connection;

    /** @var AMQPChannel $channel */
    public AMQPChannel $channel;

    /** @var string $host host name where the RabbitMQ server is running */
    protected string $host;

    /** @var string $user username to connect to server */
    protected string $user;

    /** @var int $port port number of the service, 5672 is the default */
    protected int $port;

    /** @var string $password password to connect to server */
    protected string $password;

    /** @var string $exchange exchange name */
    protected string $exchange;

    /** @var string $exchangeType exchange type */
    protected string $exchangeType;

    /** @var bool $passive can use this to check whether an exchange exists without modifying the server state */
    protected bool $passive;

    /** @var bool $durable make it persistent */
    public bool $durable;

    /** @var bool $exclusive used by only one connection and the queue will be deleted when that connection closes */
    protected bool $exclusive;

    /** @var bool $autoDelete queue is deleted when last consumer unsubscribes */
    protected bool $autoDelete;

    /** @var bool $keepAlive keep consumer alive */
    protected bool $keepAlive;

    /** @var string $queueName routing_key */
    protected string $queueName = 'notification_queue';

    /**
     *
     */
    public function __construct()
    {
        $this->host = config("queue.connections.rabbitmq.host");
        $this->port = config("queue.connections.rabbitmq.port");
        $this->user = config("queue.connections.rabbitmq.user");
        $this->password = config("queue.connections.rabbitmq.password");
        $this->exchange = config("queue.connections.rabbitmq.exchange");
        $this->exchangeType = config("queue.connections.rabbitmq.exchange_type");
        $this->passive = config("queue.connections.rabbitmq.passive");
        $this->durable = config("queue.connections.rabbitmq.durable");
        $this->exclusive = config("queue.connections.rabbitmq.exclusive");
        $this->autoDelete = config("queue.connections.rabbitmq.auto_delete");
        $this->keepAlive = config("queue.connections.rabbitmq.keep_alive");

        $this->initialize();
    }

    /**
     * @return void
     */
    public function initialize(): void
    {
        /**
         * Make Connection
         */
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);

        /**
         * Make Channel
         */
        $this->channel = $this->connection->channel();

        /**
         * Make Exchange
         */
        $this->channel->exchange_declare($this->exchange, $this->exchangeType, $this->passive, $this->durable, $this->autoDelete);

        /**
         * Declare exchange and queue
         */
        $this->queue_declare();

        /**
         * Bind Queue to Exchange
         */
        $this->queue_bind();
    }

    /**
     * @return void
     */
    public abstract function run(): void;

    /**
     * @return void
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * Keep worker alive
     *
     * @return bool
     */
    public function is_consuming(): bool
    {
        return $this->keepAlive;
    }

    /**
     * @return void
     */
    public function queue_declare(): void
    {
        $this->channel->queue_declare($this->queueName, $this->passive, $this->durable, $this->exclusive, $this->autoDelete);
    }

    /**
     * @return void
     */
    public function queue_bind(): void
    {
        $this->channel->queue_bind($this->queueName, $this->exchange, $this->queueName);
    }

    /**
     * @param AMQPMessage $message
     * @return void
     */
    public function basic_publish(AMQPMessage $message): void
    {
        $this->channel->basic_publish($message, $this->exchange, $this->queueName);
    }

    /**
     * @param $fn
     * @return void
     */
    public function basic_consume($fn): void
    {
        $this->channel->basic_consume($this->queueName, '', false, false, $this->exclusive, false, $fn);
    }

    /**
     *
     */
    public function __destruct()
    {
        /**
         * Free up memory
         */
        $this->close();
    }


}
