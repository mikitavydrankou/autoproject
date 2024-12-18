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
        Schema::create('service_request_status_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_request_id'); // ID заявки
            $table->string('status'); // Статус (например, "ожидает", "выполняется", "закрыта")
            $table->timestamps();

            $table->foreign('service_request_id')->references('id')->on('service_requests')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_request_status_histories');
    }
};
