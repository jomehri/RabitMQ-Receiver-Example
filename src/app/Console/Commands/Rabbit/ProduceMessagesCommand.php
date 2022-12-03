<?php

namespace App\Console\Commands\Rabbit;

use Illuminate\Console\Command;
use App\Services\Rabbit\ProduceMessagesService;
use App\Interfaces\Repositories\Notification\INotificationRepository;

class ProduceMessagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:produce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produces a number of fake messages in rabbitMQ';

    /** @var INotificationRepository $notificationRepository */
    private INotificationRepository $notificationRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(INotificationRepository $notificationRepository)
    {
        parent::__construct();

        $this->notificationRepository = $notificationRepository;
    }

    /**
     * Produce some fake messages in rabbitmq
     *
     * @return void
     */
    public function handle(): void
    {
        /** @var int $num number of messages to get produced */
        $num = config("rabbitmq.number_of_messages_to_produce");

        $producerService = new ProduceMessagesService();

        for ($i = 1; $i <= $num; $i++) {
            $producerService->run();
        }

        $this->line("{$num} messages produced and put in queue, ready to receive");
    }
}
