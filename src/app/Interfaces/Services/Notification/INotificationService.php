<?php

namespace App\Interfaces\Services\Notification;

interface INotificationService
{
    /**
     * @param array $data
     * @return void
     */
    public function send(array $data): void;
}
