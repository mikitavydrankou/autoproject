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
        Schema::create('service_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id'); // ID автосервиса
            $table->string('service_type'); // Тип услуги (например, "Починка стартера")
            $table->decimal('price', 8, 2); // Стандартная цена
            $table->text('description'); // Описание услуги
            $table->json('available_slots'); // Доступные слоты для выполнения услуги (массив временных промежутков)
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_templates');
    }
};
