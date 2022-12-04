<?php

namespace App\Interfaces\Services\Notification;

interface IConsumeMessageService
{
    /**
     * @return void
     */
    public function run(): void;
}
