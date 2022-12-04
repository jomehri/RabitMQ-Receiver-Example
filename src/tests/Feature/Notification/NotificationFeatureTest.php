<?php

namespace Tests\Feature\App;

use App\Services\Rabbit\ConsumeMessagesService;
use App\Services\Rabbit\ProduceMessagesService;
use Mockery\MockInterface;
use Tests\Feature\BaseFeature;

/**
 * Black Box testing for testing only starting point and end point of methods without knowing what's inside
 */
class NotificationFeatureTest extends BaseFeature
{

    /**
     * @return void
     */
    public function test_notification_produce_health_command(): void
    {
        /**
         * Mock the message, don't add real message to the queue
         */
        $this->partialMock(ProduceMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')->andReturnNull();
        });

        $this->artisan('rabbitmq:produce')->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_notification_consume_health_command(): void
    {
        /**
         * Mock the message, don't take real message from the queue
         */
        $this->partialMock(ConsumeMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')->andReturnNull();
        });

        $this->artisan('rabbitmq:consume')->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_notification_produce_has_correct_prompt_message(): void
    {
        /**
         * Mock the message, don't add real message to the queue
         */
        $this->partialMock(ProduceMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')->andReturnNull();
        });

        $this->artisan('rabbitmq:produce')
            ->expectsOutput(config("rabbitmq.number_of_messages_to_produce") . ' messages produced and put in queue, ready to receive');
    }

}
