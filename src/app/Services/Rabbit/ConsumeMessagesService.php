<?php

namespace App\Services\Rabbit;

use ErrorException;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeMessagesService extends MessagesBaseService
{

    /**
     * @return void
     * @throws ErrorException
     */
    public function run(): void
    {

        /**
         * Call back function
         */
        $fn = function ($message) {
            $prompt = "message processed and acknowledged successfully(" . $message->getBody() . ")\r\n";
            
            Log::info($prompt);
            echo $prompt;

            $this->channel->basic_ack($message->delivery_info['delivery_tag']);
        };

        /**
         * Don't put too many messages on each worker, find free workers
         */
        $this->channel->basic_qos(null, 1, null);

        /**
         * Publish message on channel
         */
        $this->basic_consume($fn);

        while ($this->is_consuming()) {
            $this->channel->wait();
        }

    }

}
