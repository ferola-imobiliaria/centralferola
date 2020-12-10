<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_controls', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('user_id');
            $table->string("store");
            $table->string("property");
            $table->string("edifice")->nullable();
            $table->string("owner");
            $table->string("owner_cpf");
            $table->string("owner_phone");
            $table->date("sale_date");
            $table->float("sale_value", 10, 2);
            $table->float("commission_percentage");
            $table->float("commission_value", 10, 2);
            $table->float("realtor_percentage");
            $table->float("realtor_commission", 10, 2);
            $table->unsignedBigInteger("catcher");
            $table->float("catcher_percentage");
            $table->float("catcher_commission", 10, 2);
            $table->unsignedBigInteger("exclusive")->nullable();
            $table->float("exclusive_percentage")->nullable();
            $table->float("exclusive_commission", 10, 2)->nullable();
            $table->unsignedBigInteger("supervisor")->nullable();
            $table->float("supervisor_percentage")->nullable();
            $table->float("supervisor_commission")->nullable();
            $table->float("real_estate_commission", 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('catcher')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exclusive')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions_controls');
    }
}
