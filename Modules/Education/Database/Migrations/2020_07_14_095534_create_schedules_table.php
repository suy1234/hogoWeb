<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `schedules` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` int(10) unsigned DEFAULT NULL,
            `subject_id` int(10) unsigned DEFAULT NULL,
            `from_date` DATETIME DEFAULT NULL,
            `to_date` DATETIME DEFAULT NULL,
            `qty` tinyint(4) DEFAULT NULL,
            `status` tinyint(2) DEFAULT '1',
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
