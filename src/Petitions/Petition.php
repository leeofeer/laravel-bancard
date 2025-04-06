<?php 

namespace Bancardgateway\Bancard\Petitions;

abstract class Petition
{
    abstract protected function token(): string;

    abstract public function getOperationPetition(): array;

    public function handlePayload(array $data = []): void
    {
        //
    }

    public function generateShopProcessId(): int
    {
        return random_int(100000000, 2339476471);
    }
}