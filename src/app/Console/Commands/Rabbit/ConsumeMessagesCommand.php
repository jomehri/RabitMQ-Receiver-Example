<?php

namespace App\Console\Commands\Rabbit;

use Illuminate\Console\Command;
use App\Interfaces\Services\Notification\IConsumeMessageService;

class ConsumeMessagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Produces a number of fake messages in rabbitMQ';

    /** @var IConsumeMessageService $consumeMessageService */
    private IConsumeMessageService $consumeMessageService;

    /**
     * @param IConsumeMessageService $consumeMessageService
     */
    public function __construct(IConsumeMessageService $consumeMessageService)
    {
        parent::__construct();

        $this->consumeMessageService = $consumeMessageService;
    }

    /**
     * Produce some fake messages in rabbitmq
     *
     * @return void
     */
    public function handle(): void
    {
        $this->consumeMessageService->run();

        $this->info("messages consumed");
    }
}
