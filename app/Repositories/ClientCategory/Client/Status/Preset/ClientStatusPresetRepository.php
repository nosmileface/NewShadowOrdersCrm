<?php

namespace App\Repositories\ClientCategory\Client\Status\Preset;

use App\Models\ClientCategory\Client\Status\Preset\ClientStatusPreset;
use App\Models\Crm\Crm;

class ClientStatusPresetRepository
{
    public function __construct(private ClientStatusPreset $clientStatusPreset){}

    public function updateOrCreate(Crm $crm, array $data): ClientStatusPreset
    {
        return $this->clientStatusPreset->query()->updateOrCreate(
            [
                'crm_id' => $crm->id,
                'data->status' => $data['status'],
                'data->reason' => $data['reason'] ?? null
            ],
            ['data' => $data]
        );
    }
}
