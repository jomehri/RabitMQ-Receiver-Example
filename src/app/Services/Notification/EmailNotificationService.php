<?php

namespace App\Services\Notification;

use App\Services\BaseService;
use App\Interfaces\Services\Notification\INotificationService;

class EmailNotificationService extends BaseService implements INotificationService
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
