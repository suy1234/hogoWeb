<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Seo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `seos` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `taxonomy_id` int(11) unsigned NULL,
            `type` char(15) DEFAULT NULL,
            `alias` varchar(255) DEFAULT NULL,
            `img` varchar(255) DEFAULT NULL,
            `slider` text COLLATE utf8mb4_unicode_ci,
            `title` varchar(200) DEFAULT NULL,
            `description` varchar(512) DEFAULT NULL,
            `keyword` varchar(512) DEFAULT NULL,
            `status` tinyint(1) unsigned DEFAULT '1',
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
        //
    }
}
