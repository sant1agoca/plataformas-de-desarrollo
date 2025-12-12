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
        // Añade la columna 'proyecto_id' a la tabla 'tareas'
        Schema::table('tareas', function (Blueprint $table) {
            // Define la columna como clave foránea, sin signo y referenciando la tabla 'proyectos'
            $table->foreignId('proyecto_id') 
                  ->constrained() // Crea la restricción de clave foránea a la tabla 'proyectos'
                  ->onDelete('cascade'); // Si se elimina el proyecto, se eliminan sus tareas.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina la columna 'proyecto_id' de la tabla 'tareas'
        Schema::table('tareas', function (Blueprint $table) {
            // Primero elimina la clave foránea (índice)
            $table->dropConstrainedForeignId('proyecto_id');
        });
    }
};