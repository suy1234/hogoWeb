<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerWebitopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_webitops', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('domain_demo')->nullable();
            $table->string('domain')->nullable();
            $table->string('package')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->char('phone')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
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
        Schema::dropIfExists('customer_webitops');
    }
}
