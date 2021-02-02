<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Question extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `questions` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `category_id` INT(10) UNSIGNED NULL,
            `group_id` INT(10) UNSIGNED NULL,
            `group_type_id` INT(10) UNSIGNED NULL,
            `title` varchar(512) NULL,
            `img` varchar(200) NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `status` tinyint(1) DEFAULT '1',
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
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
        //
    }
}
