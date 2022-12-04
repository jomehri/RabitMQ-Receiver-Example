<?php

namespace App\Services\Rabbit;

use PhpAmqpLib\Message\AMQPMessage;
use App\Interfaces\Services\Notification\IProduceMessageService;

class ProduceMessagesService extends MessagesBaseService implements IProduceMessageService
{

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
    public function run(): void
    {

        /**
         * Get random message to get published
         */
        $message = new AMQPMessage($this->generateFakeMessage());

        /**
         * Publish message on Exchange
         */
        $this->basic_publish($message);
    }

    /**
     * @return string|null
     */
    public function generateFakeMessage(): ?string
    {
        $result = $this->messages[array_rand($this->messages)];

        return json_encode($result);
    }
}
