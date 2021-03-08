<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 255)->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();

            $table->unsignedTinyInteger('rating')->default(0)->nullable();
            $table->string('alias')->nullable();
            $table->string('img')->nullable();
            $table->text('gallerys')->nullable();

            $table->unsignedInteger('project_id')->nullable();;
            $table->unsignedInteger('province_id')->nullable();;
            $table->unsignedInteger('district_id')->nullable();;
            $table->unsignedInteger('ward_id')->nullable();;
            $table->string('apartment_number')->nullable();;
            $table->string('address')->nullable();;

            $table->unsignedInteger('order')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->dateTime('is_published')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_products');
    }
}
