<?php

namespace App\Interfaces\Repositories\Notification;

interface INotificationRepository
{
    /**
     * @param array $data
     * @return void
     */
    public function logNotification(array $data): void;
}
