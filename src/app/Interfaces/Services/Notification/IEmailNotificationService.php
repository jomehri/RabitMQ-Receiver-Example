<?php

namespace App\Interfaces\Services\Notification;

interface IEmailNotificationService
{
    /**
     * @param array $data
     * @return void
     */
    public function send(array $data): void;
}
