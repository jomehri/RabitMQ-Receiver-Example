<?php

namespace Tests\Feature\App;

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
        $this->artisan('rabbitmq:produce')->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_notification_consume_health_command(): void
    {
        $this->artisan('rabbitmq:consume')->assertExitCode(0);
    }

    /**
     * @return void
     */
    public function test_notification_produce_has_correct_prompt_message(): void
    {
        $this->artisan('rabbitmq:produce')
            ->expectsOutput(config("rabbitmq.number_of_messages_to_produce") . ' messages produced and put in queue, ready to receive');
    }

}
