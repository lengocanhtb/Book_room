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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default('1'); // 1:available - 0:un available - 2 : cancel
            $table->integer('sort')->nullable();
            $table->string('title');
            $table->string('content');
            $table->string('img')->nullable();
            $table->string('contactInformation')->nullable();
            $table->string('videoUrl')->nullable();
            $table->integer('ward_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('rent_type_id')->nullable();
            $table->string('detail_address');
            $table->double('area')->nullable();
            $table->double('price')->nullable();
            $table->integer('user_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('rooms');
    }
};
