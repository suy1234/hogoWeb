<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `courses` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` CHAR(10) NULL DEFAULT 'vi',
            `title` VARCHAR(100) DEFAULT NULL,
            `school_from_year` DATE DEFAULT NULL,
            `school_to_year` DATE DEFAULT NULL,
            `created_by` INT(5) UNSIGNED NULL,
            `status` tinyint(2) DEFAULT '1',
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
