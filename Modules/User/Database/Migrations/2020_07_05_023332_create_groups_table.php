<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `groups` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `description` varchar(512) DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `img` varchar(255) DEFAULT NULL,
            `order` tinyint(4) DEFAULT NULL,
            `alias` varchar(255) DEFAULT NULL,
            `type` char(10) DEFAULT NULL,
            `status` tinyint(1) DEFAULT '1',
            `author` char(10) DEFAULT NULL,
            `created_by` INT(5) UNSIGNED NULL,
            `published_at` datetime DEFAULT NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
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
        Schema::dropIfExists('groups');
    }
}
