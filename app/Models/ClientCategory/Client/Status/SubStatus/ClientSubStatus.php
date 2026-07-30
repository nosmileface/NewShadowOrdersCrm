<?php

namespace App\Models\ClientCategory\Client\Status\SubStatus;

use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use App\Models\ClientCategory\Client\Status\ClientStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

#[Fillable(['status_id', 'name', 'type'])]
class ClientSubStatus extends Model
{
    // Relations

    public function status(): BelongsTo
    {
        return $this->belongsTo(ClientStatus::class);
    }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(
            CLientStatusCategory::class,
            'stageable',
            'client_status_category_links',
            'stageable_id',
            'client_status_category_links_id'
        )->withTimestamps();
    }
}
