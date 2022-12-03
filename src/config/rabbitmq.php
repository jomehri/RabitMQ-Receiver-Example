<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Number of messages to put in rabbitmq
    |--------------------------------------------------------------------------
    |
    */
    'number_of_messages_to_produce' => env("RABBITMQ_NUMBER_OF_MESSAGES", 1000),

];
