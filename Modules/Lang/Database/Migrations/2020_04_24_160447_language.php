<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Language extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `languages` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` CHAR(10) NULL DEFAULT 'vi',
            `title` VARCHAR(100) NOT NULL,
            `default` TINYINT(2) UNSIGNED NULL,
            `status` tinyint(2) DEFAULT '0',
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`));

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
