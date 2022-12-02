<?php

namespace App\Console\Commands\Rabbit;

use ErrorException;
use Illuminate\Console\Command;
use App\Services\Rabbit\ConsumeMessagesService;

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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Produce some fake messages in rabbitmq
     *
     * @return void
     * @throws ErrorException
     */
    public function handle(): void
    {
        $consumeService = new ConsumeMessagesService();
        $consumeService->run();

        $this->info("messages consumed");
    }
}
