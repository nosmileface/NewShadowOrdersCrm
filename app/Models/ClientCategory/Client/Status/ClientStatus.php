<?php

namespace App\Models\ClientCategory\Client\Status;

use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use App\Models\ClientCategory\Client\Status\SubStatus\ClientSubStatus;
use App\Models\Crm\Crm;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['client_id', 'crm_id', 'name', 'type'])]
class ClientStatus extends Model
{
    // Relations

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function crm(): BelongsTo
    {
        return $this->belongsTo(Crm::class);
    }

    public function subStatuses(): HasMany
    {
        return $this->hasMany(ClientSubStatus::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(
            ClientStatusCategory::class,
            'stageable',
            'client_status_category_links',
            'stageable_id',
            'client_status_category_id'
        )->withTimestamps();
    }
}
