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
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->text('description');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('country_code')->default('+966');
            $table->integer('mobile')->unique();
            $table->boolean('approved')->default(0);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnUpdate();
            $table->foreign('admin_id')->references('id')->on('admins')->cascadeOnUpdate();
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
        Schema::dropIfExists('merchants');
    }
};
