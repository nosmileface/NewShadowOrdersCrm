<?php

namespace App\Models\Crm;

use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\Client\Status\Preset\ClientStatusPreset;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'type'])]
class Crm extends Model
{
    // Relations

    public function statuses(): HasMany
    {
        return $this->hasMany(ClientStatus::class);
    }

    public function presets(): HasMany
    {
        return $this->hasMany(ClientStatusPreset::class);
    }
}
