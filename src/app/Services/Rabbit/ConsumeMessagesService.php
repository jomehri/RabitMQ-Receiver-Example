<?php

namespace App\Services\Rabbit;

use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeMessagesService extends MessagesBaseService
{

    /**
     * @return void
     */
    public function run(): void
    {

        /**
         * Call back function
         */
        $fn = function () {
            Log::info("consumed successfully");
        };

        /**
         * Publish message on channel
         */
        $this->basic_consume($fn);
    }

}
