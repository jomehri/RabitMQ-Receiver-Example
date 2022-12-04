<?php

namespace App\Services\Notification;

use App\Services\BaseService;
use App\Interfaces\Services\Notification\INotificationService;
use App\Interfaces\Services\Notification\IEmailNotificationService;

class EmailNotificationService extends BaseService implements INotificationService, IEmailNotificationService
{

    /**
     * @param array $data
     * @return void
     */
    public function send(array $data): void
    {
        /**
         * Send mail() to user
         */
        /*mail($data['to'], 'New Notification Sent', $data['message']);*/
    }

}
