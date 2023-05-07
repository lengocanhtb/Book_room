<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('fullname')->nullable();
            $table->string('status')->default('1');// 1:active, 2:in_active
            $table->integer('sort')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('0'); // 0:user , 1:admin
            $table->softDeletes();
            $table->dateTime('created_by')->nullable();
            $table->dateTime('updated_by')->nullable();
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
};
