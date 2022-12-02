<?php

namespace App\Console\Commands\Rabbit;

use Illuminate\Console\Command;
use App\Services\Rabbit\ProduceMessagesService;

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
     */
    public function handle(): void
    {
        /** @var int $num number of messages to get produced */
        $num = config("rabbitmq.number_of_messages_to_produce");

        $producerService = new ProduceMessagesService();

        for ($i = 1; $i <= $num; $i++) {
            $producerService->produce();
        }

        $this->info("{$num} messages produced and put in queue, ready to receive");
    }
}
