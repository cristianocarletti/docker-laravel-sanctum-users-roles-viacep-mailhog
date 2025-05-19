<?php

// tests/Unit/AuthServiceTest.php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\AuthService;
use App\Contracts\AddressLookupInterface;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user_with_valid_cep_creates_user(): void
    {
        $fakeAddress = [
            'street' => 'Rua Teste',
            'neighborhood' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zipcode' => '01001-000',
        ];

        $mockLookup = Mockery::mock(AddressLookupInterface::class);
        $mockLookup->shouldReceive('buscar')->with('01001-000')->andReturn($fakeAddress);

        $authService = new AuthService($mockLookup);

        $user = $authService->register([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'zipcode' => '01001-000',
            'number' => '123',
            'role' => 'user',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }
}