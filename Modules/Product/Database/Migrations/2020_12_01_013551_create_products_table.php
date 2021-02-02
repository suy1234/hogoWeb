<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TABLE `products` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `parent_id` int(10) DEFAULT 0,
            `barcode` char(30) DEFAULT NULL,
            `sku` char(30) DEFAULT NULL,

            `title` varchar(255) NOT NULL,
            `rating` tinyint(4) DEFAULT 0,
            `alias` varchar(512) NOT NULL,
            `description` varchar(512) DEFAULT NULL,
            `content` text COLLATE utf8mb4_unicode_ci,
            `img` varchar(255) DEFAULT NULL,
            `gallerys` text COLLATE utf8mb4_unicode_ci,
  
            `category_id` int(10) unsigned NOT NULL,
            `brand_id` int(10) unsigned DEFAULT NULL,
            `group_ids` CHAR(100) DEFAULT NULL,
            `properties_id` int(10) unsigned DEFAULT NULL,
            `unit_id` int(10) unsigned DEFAULT NULL,
            
            `price` double(14,2) DEFAULT '0.00',
            `price_sale` double(14,2) DEFAULT '0.00',
            `price_percent` double(14,2) DEFAULT NULL,
            `price_sort` double(14,2) DEFAULT '0.00',
            `price_customer_1` double(14,2) DEFAULT '0.00',
            `price_customer_2` double(14,2) DEFAULT '0.00',
            `price_customer_3` double(14,2) DEFAULT '0.00',
            `price_customer_4` double(14,2) DEFAULT '0.00',
            `price_customer_5` double(14,2) DEFAULT '0.00',
            `price_customer_6` double(14,2) DEFAULT '0.00',
            `price_from_date` datetime DEFAULT NULL,
            `price_to_date` datetime DEFAULT NULL,
            
            `by_pos` tinyint(1) DEFAULT 1,
            `by_website` tinyint(1) DEFAULT 1,
            `inventory_quantity` char(20) DEFAULT '0',
            `warehouses_quantity_set` tinyint(1) DEFAULT 1,
            `warehouses_quantity_warning` tinyint(1) DEFAULT 0,
            `weight` char(10) DEFAULT '0',
            `width` char(10) DEFAULT '0',
            `length` char(10) DEFAULT '0',
            `height` char(10) DEFAULT '0',

            `order` tinyint(4) DEFAULT NULL,
            `view_count` INT(5) DEFAULT '0',
            `status` tinyint(2) DEFAULT '1',
            `published_at` datetime DEFAULT NULL,
            `created_by` INT(5) UNSIGNED NULL,
            `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
            `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX id (`id`, `category_id`, `brand_id`)
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
        Schema::dropIfExists('products');
    }
}
