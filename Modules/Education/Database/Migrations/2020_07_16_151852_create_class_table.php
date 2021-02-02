<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `class` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` CHAR(10) DEFAULT NULL,
            `course_id` int(10) unsigned DEFAULT NULL,
            `subject_id` int(10) unsigned DEFAULT NULL,
            `teacher_id` int(10) unsigned DEFAULT NULL,
            `max` tinyint(4) unsigned DEFAULT '30',
            `time_theory` tinyint(4) unsigned DEFAULT '10',
            `time_practice` tinyint(4) unsigned DEFAULT '60',
            `graduation_exam` DATETIME DEFAULT NULL,
            `driving_exam_provisional` DATETIME DEFAULT NULL,
            `driving_exam` DATETIME DEFAULT NULL,
            `status` tinyint(2) DEFAULT '1',
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`, `course_id`, `subject_id`, `teacher_id`)
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
