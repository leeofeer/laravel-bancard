<?php

namespace Bancardgateway\Bancard\Operations;

use Illuminate\Http\Client\Response;
use Bancardgateway\Bancard\Petitions\{Petition, TokenCharge as TokenCargePetition};

class TokenCharge extends Operation
{
    private static string $resource = 'vpos/api/0.3/charge';

    private string $description;
    private float $amount;
    private string $aliasToken;
    private ?int $shop_process_id;

    public function __construct(string $description, float $amount, string $aliasToken, ?int $shop_process_id)
    {
        $this->description = $description;
        $this->amount = $amount;
        $this->aliasToken = $aliasToken;
        $this->shop_process_id = $shop_process_id;
    }

    protected static function getResource(): string
    {
        return self::$resource;
    }

    protected function getPetition(): Petition
    {
        return new TokenCargePetition($this->description, $this->amount, $this->aliasToken, $this->shop_process_id);
    }

    protected function handleSuccess(Petition $petition, Response $response): void
    {
        $data = $response->json();
        $petition->handlePayload($data['confirmation']);
    }
}
