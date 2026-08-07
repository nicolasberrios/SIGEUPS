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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('numero_cliente', 20);

            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('modelo_id')->constrained('modelos');

            $table->string('numero_serie')->unique();

            $table->integer('capacidad_va');

            $table->foreignId('ubicacion_id')->constrained('ubicaciones');
            $table->foreignId('estado_id')->constrained('estados');

            $table->string('foto')->nullable();

            $table->text('observaciones')->nullable();

            $table->unique(['cliente_id', 'numero_cliente']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
