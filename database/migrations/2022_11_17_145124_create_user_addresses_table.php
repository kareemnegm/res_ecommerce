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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->unsignedBigInteger('user_id');
            $table->integer('mobile');
            $table->string('street');
            $table->text('nearest_landmark')->nullable();
            $table->text('notes')->nullable();
            $table->float('longitude', 10, 6);
            $table->float('latitude', 10, 6);
            $table->boolean('is_default')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('user_addresses');
    }
};
