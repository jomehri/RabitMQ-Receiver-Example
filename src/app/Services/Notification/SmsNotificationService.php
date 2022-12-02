<?php

namespace App\Services\Notification;

use App\Services\BaseService;
use App\Interfaces\Services\Notification\INotificationService;
use Illuminate\Support\Facades\Http;

class SmsNotificationService extends BaseService implements INotificationService
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
//        Http::post($this->smsProviderUrl, $data);
    }

}
