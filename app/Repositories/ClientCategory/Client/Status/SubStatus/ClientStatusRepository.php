<?php

namespace App\Repositories\ClientCategory\Client\Status\SubStatus;

use App\Constants\Query;
use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\Crm\Crm;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ClientStatusRepository
{
    public function __construct(private ClientStatus $clientStatus){}

    public function all(Client $client): LengthAwarePaginator
    {
        return $this->clientStatus->query()
            ->where('client_id', $client->id)
            ->orderBy(Query::COLUMN_ID, Query::SORT_DESC)
            ->paginate(Query::PER_PAGE);
    }

    public function create(Client $client, array $data): ClientStatus
    {
        $data['client_id'] = $client->id;

        return $this->clientStatus->query()->create($data);
    }

    public function update(Client $client, ClientStatus $clientStatus, array $data): ClientStatus
    {
        $clientStatus->query()
            ->where('client_id', $client->id)
            ->findOrFail($clientStatus->id);

        $clientStatus->update($data);

        return $clientStatus;
    }

    public function updateOrCreate(Client $client, Crm $crm, string $name): ClientStatus
    {
        return $this->clientStatus->query()->updateOrCreate(
            ['client_id' => $client->id, 'crm_id' => $crm->id, 'type' => Str::slug($name)],
            ['name' => $name]
        );
    }

    public function delete(Client $client, ClientStatus $clientStatus): bool
    {
        return $this->clientStatus->query()
            ->where('client_id', $client->id)
            ->findOrFail($clientStatus->id)
            ->delete();
    }
}
