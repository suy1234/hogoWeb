<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->text('config')->nullable();
            $table->integer('created_by')->nullable();
            $table->tinyInteger('status')->default(-1);
            $table->timestamps();
        });

        $input = [
            [
                'id' => 1,
                'title' => "Theme mặc định",
                'status' => 1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('themes')->insert($input);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
