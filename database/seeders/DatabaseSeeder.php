<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'zipcode' => '01001-000',
            'street' => 'Rua Admin',
            'number' => '1',
            'neighborhood' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP'
        ]);

        User::factory()->create([
            'name' => 'João da Silva',
            'email' => 'joao@email.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'zipcode' => '01001-000',
            'street' => 'Rua das Flores',
            'number' => '123',
            'neighborhood' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
        ]);

        User::factory()->create([
            'name' => 'Maria Oliveira',
            'email' => 'maria@email.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'zipcode' => '30130-010',
            'street' => 'Avenida Afonso Pena',
            'number' => '456',
            'neighborhood' => 'Funcionários',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
        ]);

        User::factory()->create([
            'name' => 'Carlos Pereira',
            'email' => 'carlos@email.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'zipcode' => '80010-150',
            'street' => 'Rua Barão do Rio Branco',
            'number' => '789',
            'neighborhood' => 'Centro',
            'city' => 'Curitiba',
            'state' => 'PR',
        ]);

        User::factory(30)->create()->each(function ($user) {
            $user->update([
                'role' => rand(0, 1) ? 'admin' : 'user',
                'zipcode' => '01001-000',
                'street' => 'Rua Fictícia',
                'number' => rand(1, 999),
                'neighborhood' => 'Bairro Teste',
                'city' => 'Cidade Exemplo',
                'state' => 'SP',
            ]);
        });
    }
}
