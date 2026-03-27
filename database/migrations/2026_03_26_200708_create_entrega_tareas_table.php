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
        Schema::create('entrega_tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarea_id');
            $table->foreignId('user_id'); //Alumno que entrega la tarea
            $table->foreignId('grupo_id');
            $table->string('archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega_tareas');
    }
};
