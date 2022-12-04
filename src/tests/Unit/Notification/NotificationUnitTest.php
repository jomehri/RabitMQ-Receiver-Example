<?php

namespace Tests\Unit\Notification;

use Tests\TestCase;
use Mockery\MockInterface;
use App\Services\Rabbit\ConsumeMessagesService;
use App\Services\Rabbit\ProduceMessagesService;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * White Box testing for services without triggering real message delivery (mocking)
 */
class NotificationUnitTest extends TestCase
{

    /**
     * Test random message generator is working perfectly
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_producer_generate_random_message_is_json(): void
    {
        /**
         * Mock the message, don't add real message to the queue
         */
        $this->partialMock(ProduceMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')->andReturnNull();
        });

        $produceMessageService = $this->app->make(ProduceMessagesService::class);

        $message = $produceMessageService->generateFakeMessage();

        $this->assertJson($message);
    }

    /**
     * Test message producer runs ok
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_producer_run_method_works(): void
    {
        /**
         * Mock the message, don't add real message to the queue
         */
        $this->partialMock(ProduceMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('basic_publish')->andReturnNull();
        });

        $produceMessageService = $this->app->make(ProduceMessagesService::class);

        $this->assertNull($produceMessageService->run());
    }

    /**
     * Test message consumer runs ok
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_consumer_run_method_works(): void
    {
        /**
         * Mock the message, take real message from the queue
         */
        $this->mock(ConsumeMessagesService::class, function (MockInterface $mock) {
            $mock->shouldReceive('run')->once()->andReturnNull();
        });

        $ConsumeMessagesService = $this->app->make(ConsumeMessagesService::class);

        $this->assertNull($ConsumeMessagesService->run());
    }

}
