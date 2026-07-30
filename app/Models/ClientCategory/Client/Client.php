<?php

namespace App\Models\ClientCategory\Client;

use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\ClientCategory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'category_id',
    'name',
    'is_active',
    'code',
    'address',
    'phone',
    'legal_entity',
    'inn',
    'ogrn',
    'kpp'
])]
class Client extends Model
{
    // Relations

    public function category(): BelongsTo
    {
        return $this->belongsTo(ClientCategory::class);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(ClientStatus::class);
    }
}
