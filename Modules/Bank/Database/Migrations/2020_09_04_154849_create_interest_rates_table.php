<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `bank_interest_rates` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `title` varchar(512) NOT NULL,
            `bank_id` int(10) unsigned DEFAULT NULL,
            `category_id` int(10) unsigned DEFAULT NULL,
            `group_id` int(10) unsigned DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `bank_info` text COLLATE utf8mb4_unicode_ci,
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
        Schema::dropIfExists('bank_interest_rates');
    }
}
