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
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Auto-incremento de ID
            $table->string('photo'); // URL o ruta de la foto
            $table->string('name'); // Nombre del item
            $table->string('code')->unique(); // Código único
            $table->string('ean')->unique(); // Código EAN único
            $table->decimal('price', 8, 2); // Precio con 8 dígitos en total, 2 decimales
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
