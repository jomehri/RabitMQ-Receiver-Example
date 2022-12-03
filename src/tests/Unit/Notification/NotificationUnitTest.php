<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Rabbit\ProduceMessagesService;

class NotificationUnitTest extends TestCase
{
    /**
     * White Box test on produce service
     *
     * @return void
     */
    public function test_mockery_notification_produce_service_run()
    {
        $mock = $this
            ->getMockBuilder(ProduceMessagesService::class)
            ->setMethods(['run'])
            ->getMock();

        $mock->expects($this->once())->method('run');
        $mock->run();
    }

}
