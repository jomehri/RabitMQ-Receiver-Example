<?php

namespace App\Interfaces\Services\Notification;

interface IProduceMessageService
{
    /**
     * @return void
     */
    public function run(): void;
}
