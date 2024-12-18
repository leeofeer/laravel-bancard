<?php

namespace Bancardgateway\Bancard\Operations;

use Illuminate\Http\Client\Response;
use Bancardgateway\Bancard\Petitions\{Petition, Rollback as RollbackPetition};

class Rollback extends Operation
{
    private static string $resource = 'vpos/api/0.3/single_buy/rollback';

    private string $shopProcessId;

    public function __construct(string $shopProcessId)
    {
        $this->shopProcessId = $shopProcessId;
    }

    protected static function getResource(): string
    {
        return self::$resource;
    }

    protected function getPetition(): Petition
    {
        return new RollbackPetition($this->shopProcessId);
    }

    protected function handleSuccess(Petition $petition, Response $response): void
    {
        $petition->handlePayload($response->json());
    }
}