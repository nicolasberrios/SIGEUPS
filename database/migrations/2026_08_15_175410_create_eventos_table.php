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
        Schema::create('eventos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('ups_id')
                ->constrained('ups')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('tipo_evento_id')
                ->constrained('tipos_evento')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('usuario_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('estado_resultante_id')
                ->constrained('estados')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('ubicacion_resultante_id')
                ->constrained('ubicaciones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->dateTime('fecha_hora');

            $table->text('comentario')->nullable();

            $table->timestamps();

            $table->index('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};