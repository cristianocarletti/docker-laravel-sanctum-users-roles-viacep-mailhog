<?php
// tests/Unit/ViaCepServiceTest.php

namespace Tests\Unit;

use App\Services\ViaCep\ViaCepService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViaCepServiceTest extends TestCase
{
    public function test_buscar_cep_sucesso(): void
    {
        Http::fake([
            'https://viacep.com.br/ws/01001000/json/' => Http::response([
                'logradouro' => 'Praça da Sé',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
                'cep' => '01001-000',
            ], 200),
        ]);

        $service = new ViaCepService();
        $data = $service->buscar('01001000');

        $this->assertEquals('Praça da Sé', $data['street']);
        $this->assertEquals('Sé', $data['neighborhood']);
        $this->assertEquals('São Paulo', $data['city']);
        $this->assertEquals('SP', $data['state']);
        $this->assertEquals('01001-000', $data['zipcode']);
    }
}