<?php

// app/Services/AuthService.php (verificado e corrigido)

namespace App\Services;

use App\Contracts\AddressLookupInterface;
use App\Models\User;

class AuthService
{
    protected AddressLookupInterface $addressLookup;

    public function __construct(AddressLookupInterface $addressLookup)
    {
        $this->addressLookup = $addressLookup;
    }

    public function register(array $data): User|string
    {
        $endereco = $this->addressLookup->buscar($data['zipcode']);
        if (!$endereco) {
            return 'CEP inválido';
        }

        return User::create(array_merge($data, $endereco));
    }
}