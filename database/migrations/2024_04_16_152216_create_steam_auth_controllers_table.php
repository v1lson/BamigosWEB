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
        Schema::create('steam_auth_controllers', function (Blueprint $table) {
            $table->id();
            $table->string("steamid");
            $table->string("email");
            $table->string("dir");//->nullable() puede ser null
            $table->string("dni");//->unique() no se puede repetir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steam_auth_controllers');
    }
};
