<?php

namespace App\Models\Logs;

use App\Models\BaseModel;

class NotificationLog extends BaseModel
{

    /**
     * @return string
     */
    public static function getDBTable(): string
    {
        return 'notification_logs';
    }

    /**
     * Columns
     */
    const COLUMN_TYPE = 'type';
    const COLUMN_NAME = 'name';
    const COLUMN_MESSAGE = 'message';
    const COLUMN_SUCCESS = 'success';
    const COLUMN_SENT = 'sent';

}
