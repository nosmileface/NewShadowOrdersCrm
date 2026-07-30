<?php

namespace App\Models\ClientCategory\Client\Status\Preset;

use App\Models\Crm\Crm;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['crm_id', 'data'])]
class ClientStatusPreset extends Model
{
    protected $casts = ['data' => 'array'];

    // Relations

    public function crm(): BelongsTo
    {
        return $this->belongsTo(Crm::class);
    }
}
