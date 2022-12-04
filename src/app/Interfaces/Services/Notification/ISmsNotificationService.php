<?php

namespace App\Interfaces\Services\Notification;

interface ISmsNotificationService
{
    /**
     * @param array $data
     * @return void
     */
    public function send(array $data): void;
}
