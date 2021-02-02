<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `posts` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `category_id` int(10) unsigned DEFAULT NULL,
            `group_ids` CHAR(100) DEFAULT NULL,
            `title` varchar(255) NOT NULL,
            `alias` varchar(512) NOT NULL,
            `description` varchar(255) DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `img` varchar(255) DEFAULT NULL,
            `gallerys` text COLLATE utf8mb4_unicode_ci,
            `order` tinyint(4) DEFAULT NULL,
            `view_count` INT(5) DEFAULT '0',
            `status` tinyint(2) DEFAULT '1',
            `published_at` datetime DEFAULT NULL,
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`, `category_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        ");
        Schema::table('posts', function(Blueprint $table) {
            $table->index(['id', 'category_id']);
        });
        update_setting('layouts', ['posts', 'post']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
