<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `widgets` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) NULL,
                `type` CHAR(15) NULL,
                `parent_id` INT UNSIGNED NULL DEFAULT 0,
                `widget` CHAR(30) NULL,
                `config` TEXT NULL,
                `sort` tinyint(20) UNSIGNED NULL DEFAULT 1,
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
        Schema::dropIfExists('widgets');
    }
}
