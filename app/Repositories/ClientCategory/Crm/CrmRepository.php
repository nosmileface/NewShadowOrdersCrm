<?php

namespace App\Repositories\ClientCategory\Crm;

use App\Constants\Query;
use App\Models\Crm\Crm;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class CrmRepository
{
    public function __construct(private Crm $crm){}

    public function all(): LengthAwarePaginator
    {
        return $this->crm->query()
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate(Query::PER_PAGE);
    }

    public function updateOrCreate(string $name): Crm
    {
        return $this->crm->query()->updateOrCreate(
            ['type' => Str::slug($name)],
            ['name' => ucfirst($name)]
        );
    }
}
