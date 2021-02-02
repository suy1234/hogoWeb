<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `users` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `parent_id` int(10) unsigned DEFAULT NULL,
            `position_id` tinyint(10) unsigned DEFAULT NULL,
            `department_id` tinyint(10) unsigned DEFAULT NULL,
            `employee_id` int(10) unsigned DEFAULT NULL,
            `block_id` int(10) unsigned DEFAULT NULL,
            `role_id` int(10) unsigned DEFAULT NULL,
            `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `note` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `phone` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `remember_token` text COLLATE utf8mb4_unicode_ci,
            `passport` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `country_id` int(10) unsigned DEFAULT NULL,
            `province_id` int(10) unsigned DEFAULT NULL,
            `district_id` int(10) unsigned DEFAULT NULL,
            `ward_id` int(10) unsigned DEFAULT NULL,
            `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `gender` tinyint(4) DEFAULT NULL,
            `birthday` date DEFAULT NULL,
            `cmnd_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `cmnd_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `facebook` varchar(255) DEFAULT NULL,
            `google` varchar(255) DEFAULT NULL,
            `status` tinyint(3) unsigned DEFAULT '1',
            `permissions` text COLLATE utf8mb4_unicode_ci,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
        ");
        DB::table('users')->insert(
            array(
                'id' => 1,
                'role_id' => 1,
                'position_id' => 1,
                'department_id' => 1,
                'fullname' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'status' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
