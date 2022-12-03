<?php

namespace Tests\Feature\App;

use Tests\Feature\BaseFeature;

class NotificationFeatureTest extends BaseFeature
{

    /**
     * @return void
     */
    public function test_notification_produce_health_command(): void
    {
        $this->artisan('rabbitmq:produce')->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_notification_consume_health_command(): void
    {
        $this->artisan('rabbitmq:consume')->assertExitCode(0);
    }

}
