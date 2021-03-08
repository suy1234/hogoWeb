<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `employees` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `code` CHAR(5) NULL,
            `img` VARCHAR(255) NULL,
            `fullname` VARCHAR(255) NULL,
            `phone` CHAR(20) NULL,
            `email` VARCHAR(255) NULL,
            `sex` TINYINT(2) UNSIGNED NULL,
            `passport` CHAR(10) NULL,
            `dateRange` DATE NULL,
            `address` VARCHAR(255) NULL,
            `provincesId` TINYINT(15) UNSIGNED NULL,
            `districtId` INT(10) UNSIGNED NULL,
            `wardId` INT(10) UNSIGNED NULL,
            `nation` CHAR(10) NULL,
            `religion` CHAR(10) NULL,
            `positionsIds` CHAR(20) NULL,
            `status` TINYINT(2) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`));

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
