<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('content');
            $table->integer('quantity');
            $table->integer('amount');
            $table->string('course');
            $table->integer('campaign');
            $table->string('coupon');
            $table->integer('status');
            $table->integer('payment_complete_email_sent');
            $table->string('sheet_id');
            $table->string('transaction_code');
            $table->string('paid_via');
            $table->date('paid_date');
            $table->text('note');
            $table->string('referal');
            $table->string('utm_source');
            $table->string('client_ip');
            $table->string('full_url');
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
        Schema::dropIfExists('transactions');
    }
}
