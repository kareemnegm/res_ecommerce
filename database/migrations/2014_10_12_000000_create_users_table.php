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
            $table->id();
            $table->uuid('uuid');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('country_code')->default('+966');
            $table->string('mobile')->unique();
            $table->bigInteger('id_number')->unique();
            $table->string('password');
            $table->foreignId('country_id')->index();
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_active')->default(0);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')
                  ->references('id')
                  ->on('countries');
               
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
