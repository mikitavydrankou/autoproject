<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('service_id');
            $table->text('problem_description');
            $table->string('urgency');
            $table->string('status');
            $table->string('location');
            $table->json('attachments');
            $table->foreign('user_id', 'user_request_fk')->references('id')->on('users');
            $table->foreign('car_id', 'car_request_fk')->references('id')->on('cars');
            $table->foreign('service_id', 'service_request_fk')->references('id')->on('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
