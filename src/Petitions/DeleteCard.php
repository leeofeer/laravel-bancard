<?php

namespace Bancardgateway\Bancard\Petitions;

use Bancardgateway\Bancard\Bancard;
use Bancardgateway\Bancard\Models\Card;

class DeleteCard extends Petition
{
    private $payload;

    public function __construct(int $userId, string $aliasToken)
    {
        $this->payload = [
            'user_id' => $userId, 
            'alias_token' => $aliasToken
        ];
    }

    protected function token(): string
    {
        $privateKey = Bancard::privateKey();
        $token = "{$privateKey}delete_card{$this->payload['user_id']}{$this->payload['alias_token']}";

        return hash('md5', $token);
    }

    public function getOperationPetition(): array
    {
        return [
            'public_key' => Bancard::publicKey(), 
            'operation' => [
                'token' => $this->token(), 
                'alias_token' => $this->payload['alias_token']
            ]
        ];
    }

    public function handlePayload(array $data = []): void
    {
        Card::where('alias_token', $this->payload['alias_token'])->delete();
    }
}