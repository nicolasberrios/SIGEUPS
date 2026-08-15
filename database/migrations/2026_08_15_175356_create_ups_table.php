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
        Schema::create('ups', function (Blueprint $table) {

            $table->id();

            $table->foreignId('modelo_id')
                ->constrained('modelos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('propietario_id')
                ->constrained('propietarios')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('estado_actual_id')
                ->constrained('estados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('ubicacion_actual_id')
                ->constrained('ubicaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('numero_identificador', 50);

            $table->string('numero_serie', 100)->unique();

            $table->decimal('potencia_kva', 8, 2);

            $table->string('foto_principal')->nullable();

            $table->text('observaciones')->nullable();

            $table->timestamps();

            $table->index('numero_identificador');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ups');
    }
};