<?php

namespace App\Repositories\ClientCategory\Client\Status;

use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\Client\Status\SubStatus\ClientSubStatus;
use Illuminate\Support\Str;

class ClientSubStatusRepository
{
    public function __construct(private ClientSubStatus $clientSubStatus){}

    public function updateOrCreate(ClientStatus $clientStatus, string $name): ClientSubStatus
    {
        return $this->clientSubStatus->query()->updateOrCreate(
            ['status_id' => $clientStatus->id],
            [
                'name' => $name,
                'type' => Str::slug($name)
            ]
        );
    }
}
