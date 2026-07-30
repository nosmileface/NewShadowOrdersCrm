<?php

namespace App\Repositories\ClientCategory\Client\Status\Category;

use App\Constants\Query;
use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\ClientCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientStatusCategoryRepository
{
    public function __construct(private ClientStatusCategory $clientStatusCategory){}

    public function all(ClientCategory $clientCategory): LengthAwarePaginator
    {
        return $this->clientStatusCategory->query()
            ->where('category_id', $clientCategory->id)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate(Query::PER_PAGE);
    }

    public function findByClientAndType(string $type): ?ClientStatusCategory
    {
        return $this->clientStatusCategory->query()
            ->where('type', $type)
            ->first();
    }

    public function create(ClientCategory $clientCategory, array $data): ClientStatusCategory
    {
        $data['category_id'] = $clientCategory->id;

        return $this->clientStatusCategory->query()->create($data);
    }

    public function update(ClientCategory $clientCategory, ClientStatusCategory $clientStatusCategory, array $data): ClientStatusCategory
    {
        $clientStatusCategory->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($clientCategory->id);

        $clientStatusCategory->update($data);

        return $clientStatusCategory;
    }

    public function delete(ClientCategory $clientCategory, ClientStatusCategory $clientStatusCategory): bool
    {
        return $clientStatusCategory->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($clientStatusCategory->id)
            ->delete();
    }

    public function toggleActive(ClientCategory $clientCategory, ClientStatusCategory $clientStatusCategory): bool
    {
        $clientStatusCategory->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($clientStatusCategory->id);

        return $clientStatusCategory->update(['is_active' => !$clientStatusCategory->is_active]);
    }

    public function attach(ClientStatus $clientStatus, ClientStatusCategory $clientStatusCategory): void
    {
        $clientStatus->categories()->syncWithoutDetaching([$clientStatusCategory->id]);
    }
}
