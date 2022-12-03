<?php

namespace Tests\Unit\Notification;

use Mockery;
use ErrorException;
use Tests\TestCase;
use Illuminate\Http\JsonResponse;
use App\Services\Rabbit\ConsumeMessagesService;
use App\Services\Rabbit\ProduceMessagesService;

class NotificationUnitTest extends TestCase
{

    /**
     * White Box test on produce service
     *
     * @return void
     */
    public function test_mockery_notification_produce_service_run(): void
    {
        $mock = Mockery::mock(ProduceMessagesService::class);

        $mock->shouldReceive('run')->once()->andReturnNull();

        $mock->run();
    }

    /**
     * White Box test on consume service
     *
     * @return void
     * @throws ErrorException
     */
    public function test_mockery_notification_consume_service_run(): void
    {
        $mock = Mockery::mock(ConsumeMessagesService::class);

        $mock->shouldReceive('run')->once()->andReturnNull();

        $mock->run();
    }

    /**
     * White Box test on produce service's message generator
     *
     * @return void
     */
    public function test_mockery_notification_produce_generate_message(): void
    {
        $mock = Mockery::mock(ProduceMessagesService::class);

        $mock->shouldReceive('generateFakeMessage')->once()->andReturn(JsonResponse::class);

        $mock->generateFakeMessage();
    }

}
