<?php

namespace App\Services\Rabbit;

use App\Services\BaseService;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ProduceMessagesBaseService extends BaseService
{
    protected string $host;

    /**
     *
     */
    public function __construct()
    {
        $this->host = config("rabbitmq.host");
    }

    /**
     * @return void
     */
    public function produce(): void
    {
        $connection = new AMQPStreamConnection(
            'localhost',    #host - host name where the RabbitMQ server is runing
            5672,           #port - port number of the service, 5672 is the default
            'guest',        #user - username to connect to server
            'guest'         #password
        );

        $channel = $connection->channel();

        $channel->queue_declare(
            'pizzaTime',    #queue name - Queue names may be up to 255 bytes of UTF-8 characters
            false,          #passive - can use this to check whether an exchange exists without modifying the server state
            false,          #durable - make sure that RabbitMQ will never lose our queue if a crash occurs - the queue will survive a broker restart
            false,          #exclusive - used by only one connection and the queue will be deleted when that connection closes
            false           #autodelete - queue is deleted when last consumer unsubscribes
        );

        $msg = new AMQPMessage($message);

        $channel->basic_publish(
            $msg,           #message
            '',             #exchange
            'pizzaTime'     #routing key
        );

        $channel->close();
        $connection->close();
    }
}
