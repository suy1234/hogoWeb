<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `layouts` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(255) DEFAULT NULL,
                `type` char(15) DEFAULT NULL,
                `theme_id` int(10) unsigned DEFAULT NULL,
                `page_id` int(10) unsigned DEFAULT NULL,
                `parent_id` varchar(45) DEFAULT NULL,
                `created_by` int(10) unsigned DEFAULT NULL,
                `class` varchar(45) DEFAULT NULL,
                `widget_id` int(10) unsigned DEFAULT NULL,
                `widget` varchar(45) DEFAULT NULL,
                `widget_type` char(15) DEFAULT NULL,
                `has_database` TINYINT(1) NULL DEFAULT 0,
                `config` text,
                `order` tinyint(10) unsigned DEFAULT NULL,
                `status` tinyint(10) DEFAULT '1',
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ");

        $input = [
            [
                'id' => 1,
                'theme_id' => 1,
                'title' => "Header Page",
                'type' => 'header',
                'status' => 1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'id' => 2,
                'theme_id' => 1,
                'title' => "Footer Page",
                'type' => 'footer',
                'status' => 1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('layouts')->insert($input);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}
