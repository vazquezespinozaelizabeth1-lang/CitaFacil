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
        Schema::create('recordatorios', function (Blueprint $table) {
    $table->id();
    $table->foreignId('cita_id')->constrained('citas')->cascadeOnDelete();
    $table->string('mensaje', 255);
    $table->dateTime('fecha_envio');
    $table->string('canal', 20)->default('correo');
    $table->boolean('enviado')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recordatorios');
    }
};
