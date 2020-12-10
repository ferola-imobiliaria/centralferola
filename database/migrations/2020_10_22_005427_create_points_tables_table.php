<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_tables', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('score_captured_properties')->default(0);
            $table->integer('score_captured_exclusives')->default(0);
            $table->integer('score_published_ads')->default(0);
            $table->integer('score_plaques')->default(0);
            $table->integer('score_sales')->default(0);
            $table->integer('target_first_quarter')->default(0);
            $table->integer('target_second_quarter')->default(0);
            $table->integer('target_third_quarter')->default(0);
            $table->integer('target_fourth_quarter')->default(0);
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
        Schema::dropIfExists('points_tables');
    }
}
