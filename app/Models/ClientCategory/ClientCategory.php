<?php

namespace App\Models\ClientCategory;

use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'type'])]
class ClientCategory extends Model
{
    // Relations

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'category_id');
    }

    public function statusCategories(): HasMany
    {
        return $this->hasMany(ClientStatusCategory::class, 'category_id');
    }
}
