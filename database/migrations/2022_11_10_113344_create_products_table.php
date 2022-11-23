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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price');
            $table->double('offer_price')->default(0);
            $table->integer('stock_quantity');
            $table->integer('weight')->nullable();
            $table->integer('order')->default(1);
            $table->boolean('is_published')->default(0);
            $table->unsignedBigInteger('merchant_id')->index();
            $table->foreign('merchant_id')->references('id')->on('merchants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('merchant_category_id')->index();
            $table->foreign('merchant_category_id')->references('id')->on('merchant_categories')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('products');
    }
};
