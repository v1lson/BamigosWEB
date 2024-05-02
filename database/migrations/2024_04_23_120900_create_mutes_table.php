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
        Schema::create('mutes', function (Blueprint $table) {
            $table->id();
            $table->string("id_servidor");
            $table->string("steam_id");
            $table->string("nombre");
            $table->string("razon");
            $table->string("nombre_moderador");
            $table->integer("tiempo_inicio");
            $table->integer("tiempo_final");
            $table->timestamps();
            $table->string("nombre_penalizador")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutes');
    }
};
