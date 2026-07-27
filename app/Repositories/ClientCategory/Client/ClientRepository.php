<?php

namespace App\Repositories\ClientCategory\Client;

use App\Constants\Query;
use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\ClientCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository
{
    public function __construct(private Client $client){}

    public function all(ClientCategory $clientCategory): LengthAwarePaginator
    {
        return $this->client->query()
            ->where('category_id', $clientCategory->id)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate(Query::PER_PAGE);
    }

    public function create(ClientCategory $clientCategory, array $data): Client
    {
        $data['category_id'] = $clientCategory->id;

        return $this->client->query()->create($data);
    }

    public function update(ClientCategory $clientCategory, Client $client, array $data): Client
    {
        $client->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($client->id)
            ->update($data);

        return $client;
    }

    public function updateOrCreate(?ClientCategory $clientCategory, array $data): Client
    {
        return $this->client->query()->updateOrCreate(
            ['code' => $data['code'] ?? null],
            [
                'category_id' => $clientCategory?->id,
                'name' => $data['name'],
                'address' => $data['address'] ?? null,
                'phone' => $data['phone'] ?? null,
                'legal_entity' => $data['legal_entity'] ?? null,
                'inn' => $data['inn'] ?? null,
                'ogrn' => $data['ogrn'] ?? null,
                'kpp' => $data['kpp'] ?? null
            ]
        );
    }

    public function delete(ClientCategory $clientCategory, Client $client): bool
    {
        return $client->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($client->id)
            ->delete();
    }

    public function toggleActive(ClientCategory $clientCategory, Client $client): bool
    {
        return $client->query()
            ->where('category_id', $clientCategory->id)
            ->findOrFail($client->id)
            ->update(['is_active' => !$client->is_active]);
    }
}
