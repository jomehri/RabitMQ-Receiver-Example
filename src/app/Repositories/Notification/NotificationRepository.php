<?php

namespace App\Repositories\Notification;

use Illuminate\Support\Facades\DB;
use App\Models\Logs\NotificationLog;
use App\Repositories\BaseRepository;
use App\Interfaces\Repositories\Notification\INotificationRepository;

class NotificationRepository extends BaseRepository implements INotificationRepository
{

    /**
     * @param array $data
     * @return void
     */
    public function logNotification(array $data): void
    {
        $sql = "INSERT INTO " . NotificationLog::getDBTable() .
            "(`" . NotificationLog::COLUMN_TYPE . "`,
            `" . NotificationLog::COLUMN_NAME . "`,
            `" . NotificationLog::COLUMN_MESSAGE . "`,
            `" . NotificationLog::COLUMN_SUCCESS . "`,
            `" . NotificationLog::COLUMN_SENT . "`)" .
            " VALUES(
            '" . $data['type'] . "',
            '" . $data['name'] . "',
            '" . $data['message'] . "',
            1,
            '" . now() . "');";

        DB::statement($sql);
    }
}
