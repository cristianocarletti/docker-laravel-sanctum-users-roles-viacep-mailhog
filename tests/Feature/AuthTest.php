<?php
// tests/Feature/AuthTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Teste',
            'email' => 'teste@email.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'role' => 'user',
            'zipcode' => '01001-000',
            'street' => 'Rua Teste',
            'number' => '123',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'SP'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_user()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token', 'user']);
    }
}