<?php

namespace App\Services\Rabbit;

use Throwable;
use ErrorException;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;
use App\Interfaces\Services\Notification\IConsumeMessageService;
use App\Interfaces\Repositories\Notification\INotificationRepository;

class ConsumeMessagesService extends MessagesBaseService implements IConsumeMessageService
{

    /** @var INotificationRepository $notificationRepository */
    private INotificationRepository $notificationRepository;

    /**
     * @param INotificationRepository $notificationRepository
     */
    public function __construct(INotificationRepository $notificationRepository)
    {
        parent::__construct();

        $this->notificationRepository = $notificationRepository;
    }


    /**
     * @return void
     * @throws ErrorException
     */
    public function run(): void
    {

        /**
         * Call back function
         */
        $fn = function ($message) {

            $msg = $this->getMessageBody($message);

            try {

                $this->sendDynamicNotification($msg);

                /**
                 * Log success notifications in database
                 */
                $this->notificationRepository->logNotification($msg);

                /**
                 * Tell rabbitMQ to remove this message from queue, it's DONE
                 */
                $this->channel->basic_ack($message->delivery_info['delivery_tag']);

            } catch (Throwable $exception) {
                Log::error("Notification not sent!", $msg);
                throw $exception;
            }
        };

        /**
         * Don't put too many messages on each worker, find free workers
         */
        $this->channel->basic_qos(null, 1, null);

        /**
         * Publish message on channel
         */
        $this->basic_consume($fn);

        while ($this->is_consuming()) {
            $this->channel->wait();
        }

    }

    /**
     * @param AMQPMessage $message
     * @return array
     */
    private function getMessageBody(AMQPMessage $message): array
    {
        return json_decode($message->getBody(), true);
    }

    /**
     * @param array $msg
     * @return void
     */
    function sendDynamicNotification(array $msg): void
    {
        $notificationNameSpace = 'App\Services\Notification';
        $type = ucfirst($msg['type']);
        $notificationClass = $notificationNameSpace . '\\' . $type . 'NotificationService';
        $service = new $notificationClass;

        $service->send($msg);
    }

}
