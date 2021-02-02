<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `pages` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `type` char(20) DEFAULT NULL,
            `page_default` tinyint(4) DEFAULT NULL,
            `category_id` int(10) unsigned DEFAULT NULL,
            `title` varchar(255) NOT NULL,
            `alias` varchar(512) NOT NULL,
            `description` varchar(255) DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `img` varchar(255) DEFAULT NULL,
            `gallerys` text COLLATE utf8mb4_unicode_ci,
            `order` tinyint(4) DEFAULT '1',
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
        Schema::table('pages', function(Blueprint $table) {
            $table->index(['id', 'category_id']);
        });
        $input = [
            [
                'id' => 1,
                'type' => "homepage",
                'page_default' => 1,
                'title' => "Trang chủ",
                'alias' => "trang chu",
                'description' => "Trang chủ",
                'published_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'type' => "404",
                'page_default' => null,
                'title' => "Không tìm thấy trang",
                'alias' => "404",
                'description' => "Không tìm thấy trang",
                'published_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('pages')->insert($input);
        update_setting('layouts', ['page', 'footer', 'header', 'topnav']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
