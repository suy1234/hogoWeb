<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget_themes', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->char('type');
            $table->text('setting')->nullable();
            $table->text('config')->nullable();
            $table->text('css')->nullable();
            $table->text('sass_css')->nullable();
            $table->text('js')->nullable();
            $table->text('html')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->nullable()->default(1);
            $table->integer('view')->nullable()->default(1);
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('widget_themes');
    }
}
