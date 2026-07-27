<?php

namespace App\Models\ClientCategory;

use App\Models\ClientCategory\Client\Client;
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
}
