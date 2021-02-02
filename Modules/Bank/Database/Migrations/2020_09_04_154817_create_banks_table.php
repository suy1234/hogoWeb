<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `banks` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` char(50) NOT NULL,
            `title` varchar(512) NOT NULL,
            `description` varchar(255) DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `gallerys` text COLLATE utf8mb4_unicode_ci,
            `img` varchar(255) DEFAULT NULL,
            `order` tinyint(4) DEFAULT NULL,
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
        Schema::dropIfExists('banks');
    }
}
