<?php

namespace App\Services\Notification;

use App\Services\BaseService;
use Illuminate\Support\Facades\Http;
use App\Interfaces\Services\Notification\INotificationService;
use App\Interfaces\Services\Notification\ISmsNotificationService;

class SmsNotificationService extends BaseService implements INotificationService, ISmsNotificationService
{
    /** @var string $smsProviderUrl */
    private string $smsProviderUrl;

    /**
     *
     */
    public function __construct()
    {
        $this->smsProviderUrl = config("sms.SMS_PROVIDER_URL");
    }


    /**
     * @param array $data
     * @return void
     */
    public function send(array $data): void
    {
        /**
         * Send sms() to user
         */
        /*Http::post($this->smsProviderUrl, $data);*/
    }

}
