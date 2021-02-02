<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `customers` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` CHAR(10) DEFAULT NULL,
            `type` CHAR(10) DEFAULT 'customer',
            `parent_id` INT(10) UNSIGNED DEFAULT '0',
            `fullname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `phone` char(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `gender` tinyint(4) DEFAULT NULL,
            `birthday` date DEFAULT NULL,
            `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `remember_token` text COLLATE utf8mb4_unicode_ci,
            `passport` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `country_id` int(10) unsigned DEFAULT NULL,
            `province_id` int(10) unsigned DEFAULT NULL,
            `district_id` int(10) unsigned DEFAULT NULL,
            `ward_id` int(10) unsigned DEFAULT NULL,
            `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `cmnd_back` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `cmnd_front` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `note` text COLLATE utf8mb4_unicode_ci,
            
            `is_organization` tinyint(1) unsigned DEFAULT '0',
            `organization_id` int(10) unsigned DEFAULT NULL,
            `organization_size` tinyint(4) unsigned DEFAULT NULL,
            `organization_type` tinyint(4) unsigned DEFAULT NULL,
            `organization_career` tinyint(4) unsigned DEFAULT NULL,
            `organization_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `organization_phone` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `organization_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            
            `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `vat` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `level` tinyint(4) unsigned DEFAULT NULL,

            `affiliate_id` int(10) unsigned DEFAULT NULL,
            `event_id` int(11) unsigned DEFAULT NULL,
            `agency_id` int(11) unsigned DEFAULT NULL,
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
        Schema::dropIfExists('customer');
    }
}
