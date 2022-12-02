<?php

use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;
use App\Models\Logs\NotificationLog;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationLogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . NotificationLog::getDBTable() . " (
                    " . BaseModel::COLUMN_ID . " int(10) unsigned NOT NULL AUTO_INCREMENT,
                    " . NotificationLog::COLUMN_TYPE . " enum('sms', 'email') NOT NULL,
                    " . NotificationLog::COLUMN_NAME . " varchar(200) NOT NULL,
                    " . NotificationLog::COLUMN_MESSAGE . " text NOT NULL,
                    " . NotificationLog::COLUMN_SUCCESS . " smallint(1) unsigned NOT NULL,
                    " . NotificationLog::COLUMN_SENT . " timestamp NOT NULL,
                    PRIMARY KEY (" . BaseModel::COLUMN_ID . ")
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(NotificationLog::getDBTable());
    }

}
