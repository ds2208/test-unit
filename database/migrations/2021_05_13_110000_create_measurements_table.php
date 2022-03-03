<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->integer('priority');
            $table->double('top_left_sensor');
            $table->double('top_right_sensor');
            $table->double('bottom_left_sensor');
            $table->double('bottom_right_sensor');
            $table->integer('vertical_engine')->default(1001);
            $table->integer('horizontal_engine')->default(2001);
            $table->string('title');
            $table->integer('user_id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('ads');
    }
}
