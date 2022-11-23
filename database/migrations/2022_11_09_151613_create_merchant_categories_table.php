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
        Schema::create('merchant_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('merchant_category_id')->nullable();
            $table->unsignedBigInteger('merchant_id');
            $table->foreign('merchant_category_id')->references('id')->on('merchant_categories')->cascadeOnDelete();
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnDelete();
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
        Schema::dropIfExists('merchant_categories');
    }
};
