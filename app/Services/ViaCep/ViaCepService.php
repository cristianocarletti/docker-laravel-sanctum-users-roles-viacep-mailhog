<?php
//app/Services/ViaCep/ViaCepService.php

namespace App\Services\ViaCep;

use App\Contracts\AddressLookupInterface;
use Illuminate\Support\Facades\Http;

class ViaCepService implements AddressLookupInterface
{
    public function buscar(string $cep): ?array
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful() && !$response->json('erro')) {
            return [
                'street' => $response->json('logradouro'),
                'neighborhood' => $response->json('bairro'),
                'city' => $response->json('localidade'),
                'state' => $response->json('uf'),
                'zipcode' => $response->json('cep'),
            ];
        }

        return null;
    }
}
