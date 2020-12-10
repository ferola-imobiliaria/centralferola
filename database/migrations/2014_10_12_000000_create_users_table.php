<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('name');
            $table->string('name_short');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('cpf')->unique();
            $table->string('creci')->unique();
            $table->string('phone');
            $table->enum('profile', ['admin', 'supervisor', 'realtor']);
            $table->string('password');
            $table->boolean('password_change')->default(1);
            $table->string('photo')->nullable();
            $table->datetime('last_login_at')->nullable();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
