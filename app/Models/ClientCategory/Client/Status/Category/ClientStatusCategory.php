<?php

namespace App\Models\ClientCategory\Client\Status\Category;

use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\Client\Status\SubStatus\ClientSubStatus;
use App\Models\ClientCategory\ClientCategory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['category_id', 'name', 'type', 'is_active'])]
class ClientStatusCategory extends Model
{
    // Relations

    public function category(): BelongsTo
    {
        return $this->belongsTo(ClientCategory::class);
    }

    public function statuses(): MorphToMany
    {
        return $this->morphedByMany(
            ClientStatus::class,
            'stageable',
            'client_status_category_links',
            'client_status_category_id',
            'stageable_id'
        )->withTimestamps();
    }

    public function subStatuses(): MorphToMany
    {
        return $this->morphedByMany(
            ClientSubStatus::class,
            'stageable',
            'client_status_category_links',
            'client_status_category_id',
            'stageable_id'
        )->withTimestamps();
    }
}
