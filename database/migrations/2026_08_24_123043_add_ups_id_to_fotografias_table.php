<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fotografias', function (Blueprint $table) {

            if (! Schema::hasColumn('fotografias', 'ups_id')) {
                $table->foreignId('ups_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('ups')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            }

        });

        Schema::table('fotografias', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
        });

        DB::statement('ALTER TABLE fotografias MODIFY evento_id BIGINT UNSIGNED NULL');

        Schema::table('fotografias', function (Blueprint $table) {
            $table->foreign('evento_id')
                ->references('id')
                ->on('eventos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('fotografias', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
        });

        DB::statement('ALTER TABLE fotografias MODIFY evento_id BIGINT UNSIGNED NOT NULL');

        Schema::table('fotografias', function (Blueprint $table) {
            $table->foreign('evento_id')
                ->references('id')
                ->on('eventos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::table('fotografias', function (Blueprint $table) {

            if (Schema::hasColumn('fotografias', 'ups_id')) {
                $table->dropForeign(['ups_id']);
                $table->dropColumn('ups_id');
            }

        });
    }
};