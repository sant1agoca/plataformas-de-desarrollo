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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            // Campos obligatorios según la rúbrica
            $table->string('nombre', 255); //
            $table->text('descripcion')->nullable(); //
            $table->date('fecha_inicio'); //
            $table->date('fecha_fin')->nullable(); //

            // CORRECCIÓN CRÍTICA: Clave Foránea de Usuario
            // Se asume que tu tabla de usuarios se llama 'usuarios' (por tu modelo Usuario.php)
            // Agregamos ->nullable() para que puedas crear el proyecto sin enviar el 'usuario_id' en Postman.
            $table->foreignId('usuario_id')
                  ->nullable() 
                  ->constrained('usuarios') 
                  ->onDelete('set null'); // Opcional: si el usuario se elimina, la FK se pone en NULL.
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};