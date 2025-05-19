<?php

// app/Contracts/AddressLookupInterface.php

namespace App\Contracts;

interface AddressLookupInterface
{
    public function buscar(string $cep): ?array;
}