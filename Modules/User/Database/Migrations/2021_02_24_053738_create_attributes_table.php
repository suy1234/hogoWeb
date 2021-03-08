<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->char('type')->nullable();
            $table->char('form_type')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->text('config')->nullable();
            $table->tinyInteger('order')->default(0)->nullable();
            $table->tinyInteger('status')->default(-1)->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
