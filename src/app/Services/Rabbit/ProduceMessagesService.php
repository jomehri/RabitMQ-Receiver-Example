<?php

namespace App\Services\Rabbit;

use PhpAmqpLib\Message\AMQPMessage;

class ProduceMessagesService extends ProduceMessagesBaseService
{
    protected string $queueName = 'notification_queue';

    /** @var array $messages */
    private array $messages = [
        [
            'to' => '989121111111',
            'name' => 'John Smith',
            'message' => 'Hello John, Your order is ready.',
            'type' => 'sms',
        ],
        [
            'to' => 'john.smith@gmail.com',
            'name' => 'John Smith',
            'message' => '<b>Hello John</b>, <br /> <h3>Your order is ready.</h3>',
            'type' => 'email',
        ]
    ];


    /**
     * @return void
     */
    public function produce(): void
    {
        /**
         * Declare exchange and queue
         */
        $this->queue_declare();

        /**
         * Get message to be published
         */
        $message = new AMQPMessage($this->generateFakeMessage());

        /**
         * Publish message on channel
         */
        $this->basic_publish($message);

        /**
         * Free up memory
         */
        $this->close();
    }

    /**
     * @return false|string
     */
    private function generateFakeMessage()
    {
        $result = $this->messages[array_rand($this->messages)];

        return json_encode($result);
    }
}
