<?php

namespace App\Services\Sync\ShadowDomain\Client;

use App\Repositories\ClientCategory\Client\ClientRepository;
use App\Repositories\ClientCategory\ClientCategoryRepository;
use App\Services\Sync\ShadowDomain\FetchShadowDomainService;

readonly class SyncShadowDomainClientService
{
    public function __construct(
        private ClientCategoryRepository    $clientCategoryRepository,
        private CLientRepository            $clientRepository,
        private FetchShadowDomainService    $fetchShadowDomainService
    ){}

    public function sync(): int
    {
        $imported = 0;

        $clients = $this->fetchShadowDomainService->fetchClients();

        if (empty($clients)) {
            return 0;
        }

        foreach ($clients as $client) {
            if (empty($client['code'])) {
                continue;
            }

            $clientCategory = $this->clientCategoryRepository->findByType(type: $client['category']['prefix'] ?? null);

            $this->clientRepository->updateOrCreate(clientCategory: $clientCategory, data: $client);

            $imported++;
        }

        return $imported;
    }
}
