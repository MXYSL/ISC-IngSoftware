// database/migrations/create_roles_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        // Insertar roles por defecto
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'description' => 'Administrador'],
            ['id' => 2, 'name' => 'user', 'description' => 'Usuario normal'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};