<?php

use Datalogix\Admin\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    public function getConnection()
    {
        return Admin::connection();
    }

    public function up()
    {
        Schema::create(config('admin.database.tables.users'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('admin.database.tables.users'));
    }
}
