<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash; 

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@correo.com',
            'password' => Hash::make('Hola'),
            'role' => 'administrador',
        ]);

        \App\Models\User::create([
            'name' => 'Becario',
            'email' => 'becario@correo.com',
            'password' => Hash::make('Hola'),
            'role' => 'becario',
        ]);

        \App\Models\libro::create([
            'titulo' => 'El principito',
            'autor' => 'Antoine de Saint-Exupéry',
            'editorial' => 'Salvat',
            'isbn' => '978-84-345-3153-7',
        ]);

        \App\Models\libro::create([
            'titulo' => 'El señor de los anillos',
            'autor' => 'J.R.R. Tolkien',
            'editorial' => 'Minotauro',
            'isbn' => '978-84-450-7709-3',
        ]);

        \App\Models\libro::create([
            'titulo' => 'Don Quijote de la Mancha',
            'autor' => 'Miguel de Cervantes',
            'editorial' => 'Alfaguara',
            'isbn' => '978-84-204-6973-3',
        ]);

        \App\Models\libro::create([
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'editorial' => 'Diana',
            'isbn' => '978-84-376-0494-7',
        ]);

        \App\Models\persona::create([
            'nombre' => 'Juan',
            'telefono' => '987654321',
            'direccion' => 'Calle 123',
        ]);
        
        \App\Models\persona::create([
            'nombre' => 'Pedro',
            'telefono' => '123456789',
            'direccion' => 'Calle 321',
        ]);

        \App\Models\persona::create([
            'nombre' => 'María',
            'telefono' => '123456789',
            'direccion' => 'Calle 321',
        ]);

        \App\Models\persona::create([
            'nombre' => 'Ana',
            'telefono' => '123456789',
            'direccion' => 'Calle 321',
        ]);
    }
}
