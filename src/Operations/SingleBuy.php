<?php

namespace Bancardgateway\Bancard\Operations;

use Illuminate\Http\Client\Response;
use Bancardgateway\Bancard\Petitions\{Petition, SingleBuy as SingleBuyPetition};

class SingleBuy extends Operation
{
    private static string $resource = 'vpos/api/0.3/single_buy';

    private string $description;
    private float $amount;
    private ?int $shop_process_id;

    public function __construct(string $description, float $amount, ?int $shop_process_id = null)
    {
        $this->description = $description;
        $this->amount = $amount;
        $this->shop_process_id = $shop_process_id;
    }

    protected static function getResource(): string
    {
        return self::$resource;
    }

    protected function getPetition(): Petition
    {
        return new SingleBuyPetition($this->description, $this->amount, $this->shop_process_id);
    }

    protected function handleSuccess(Petition $petition, Response $response): void
    {
        $petition->handlePayload($response->json());
    }
}
