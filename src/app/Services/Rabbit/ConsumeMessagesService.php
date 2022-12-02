<?php

namespace App\Services\Rabbit;

use ErrorException;
use Illuminate\Support\Facades\Log;

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
        $fn = function () {
            Log::info("consumed successfully");
        };

        /**
         * Publish message on channel
         */
        $this->basic_consume($fn);

//        while ($this->channel->is_open()) {
//            $this->channel->wait();
//        }
    }

}
