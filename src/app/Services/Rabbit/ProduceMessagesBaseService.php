<?php

namespace App\Services\Rabbit;

use App\Services\BaseService;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class ProduceMessagesBaseService extends BaseService
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

    /** @var string $exchange exchange type */
    protected string $exchange;

    /** @var bool $passive can use this to check whether an exchange exists without modifying the server state */
    protected bool $passive;

    /** @var bool $durable make it persistent */
    public bool $durable;

    /** @var bool $exclusive used by only one connection and the queue will be deleted when that connection closes */
    protected bool $exclusive;

    /** @var bool $autoDelete queue is deleted when last consumer unsubscribes */
    protected bool $autoDelete;

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
        $this->passive = config("queue.connections.rabbitmq.passive");
        $this->durable = config("queue.connections.rabbitmq.durable");
        $this->exclusive = config("queue.connections.rabbitmq.exclusive");
        $this->autoDelete = config("queue.connections.rabbitmq.auto_delete");

        $this->initialize();
    }

    /**
     * @return void
     */
    protected function initialize(): void
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->password);

        $this->channel = $this->connection->channel();
    }

    /**
     * @return void
     */
    public abstract function produce(): void;

    /**
     * @return void
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    /**
     * @return void
     */
    public function queue_declare(): void
    {
        $this->channel->queue_declare($this->queueName, $this->passive, $this->durable, $this->exclusive, $this->autoDelete);
    }

    /**
     * @param $message
     * @return void
     */
    public function basic_publish($message): void
    {
        $this->channel->basic_publish($message, $this->exchange, $this->queueName);
    }
}
