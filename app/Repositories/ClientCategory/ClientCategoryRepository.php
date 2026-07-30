<?php

namespace App\Repositories\ClientCategory;

use App\Constants\Query;
use App\Models\ClientCategory\ClientCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientCategoryRepository
{
    private const array RELATIONS = ['clients', 'statusCategories'];

    public function __construct(private ClientCategory $clientCategory){}

    public function all(): LengthAwarePaginator
    {
        return $this->clientCategory->query()
            ->withCount(self::RELATIONS)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate(Query::PER_PAGE);
    }

    public function findByType(string $type): ?ClientCategory
    {
        return $this->clientCategory->query()
            ->where('type', $type)
            ->first();
    }

    public function create(array $data): ClientCategory
    {
        return $this->clientCategory->query()->create($data);
    }

    public function update(ClientCategory $clientCategory, array $data): ClientCategory
    {
        $clientCategory->update($data);

        return $clientCategory;
    }

    public function updateOrCreate(array $data): ClientCategory
    {
        return $this->clientCategory->query()->updateOrCreate(
            ['type' => $data['prefix']],
            ['name' => $data['name']]
        );
    }

    public function delete(ClientCategory $clientCategory): bool
    {
        return $clientCategory->delete();
    }
}
