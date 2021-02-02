<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `settings` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `type` CHAR(20) NULL,
            `config` text COLLATE utf8mb4_unicode_ci,
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
            ");

        $input = [
            [
                'type' => 'admin',
                'config' => json_encode([
                    'navbar_logo_background' => '#252b38',
                    'navbar_background' => '#2a3140',
                    'navbar_background_hover' => 'rgba(255,255,255,.1)',
                    'navbar_color' => '#fff',
                    'navbar_color_hover' => '#fff',
                    'navbar_top_background' => '#FFFFFF',
                    'navbar_top_background_hover' => 'rgba(0,0,0,.04)',
                    'navbar_top_color' => '#333',
                    'navbar_top_color_hover' => '#333'
                ])
            ],[
                'type' => 'activation_date',
                'config' => json_encode([
                    'register_date' => date('d-m-Y H:i:s'),
                    'folder' => date('jnY'),
                ])
            ],[
                'type' => 'package',
                'config' => json_encode(['User', 'Core', 'App', 'Media'])
            ]
        ];
        DB::table('settings')->insert($input);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
