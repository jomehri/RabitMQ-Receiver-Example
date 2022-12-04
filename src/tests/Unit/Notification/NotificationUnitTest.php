<?php

namespace Tests\Unit\Notification;

use Mockery\MockInterface;
use Tests\TestCase;
use App\Services\Rabbit\ProduceMessagesService;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * White Box testing for services without triggering real message delivery (mocking)
 */
class NotificationUnitTest extends TestCase
{

    /**
     * White Box test on produce service
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function test_generate_random_message_is_json(): void
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

}
