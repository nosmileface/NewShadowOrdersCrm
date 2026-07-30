<?php

namespace App\Services\Sync\AnalyticDatabase\ClientStatus;

use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\Crm\Crm;
use App\Repositories\ClientCategory\Client\ClientRepository;
use App\Repositories\ClientCategory\Client\Status\Category\ClientStatusCategoryRepository;
use App\Repositories\ClientCategory\Client\Status\ClientSubStatusRepository;
use App\Repositories\ClientCategory\Client\Status\Preset\ClientStatusPresetRepository;
use App\Repositories\ClientCategory\Client\Status\SubStatus\ClientStatusRepository;
use App\Repositories\ClientCategory\Crm\CrmRepository;
use App\Services\Sync\AnalyticDatabase\FetchAnalyticDatabaseService;
use Illuminate\Support\Collection;

readonly class SyncAnalyticDatabaseClientStatusService
{
    public function __construct(
        private FetchAnalyticDatabaseService    $fetchAnalyticDatabaseService,
        private CrmRepository                   $crmRepository,
        private ClientStatusRepository          $clientStatusRepository,
        private ClientSubStatusRepository       $clientSubStatusRepository,
        private ClientRepository                $clientRepository,
        private ClientStatusCategoryRepository  $clientStatusCategoryRepository,
        private ClientStatusPresetRepository    $clientStatusPresetRepository
    ){}

    public function sync(): int
    {
        $externalClientStatuses = $this->fetchAnalyticDatabaseService->fetch();

        $imported = 0;

        foreach ($externalClientStatuses as $externalClientStatus) {
            $crm = $this->addCrm(name: $externalClientStatus->crm);

            if (!empty($externalClientStatus->salon)) {
                $this->processForClients(externalClientStatus: $externalClientStatus, crm: $crm);
            } else {
                $this->addClientStatusPreset(crm: $crm, externalClientStatus: $externalClientStatus);
            }

            $imported++;
        }

        return $imported;
    }

    private function processForClients(object $externalClientStatus, Crm $crm): void
    {
        $clients = $this->findClients(name: $externalClientStatus->salon);

        if ($clients->isEmpty()) {
            $this->addClientStatusPreset(crm: $crm, externalClientStatus: $externalClientStatus);

            return;
        }

        foreach ($clients as $client) {
            $clientStatus = $this->addClientStatus(client: $client, crm: $crm, name: $externalClientStatus->status);

            $this->attachClientSubStatus(externalClientStatus: $externalClientStatus, clientStatus: $clientStatus);

            $this->attachClientStatusCategory(externalClientStatus: $externalClientStatus, clientStatus: $clientStatus);
        }
    }

    private function attachClientStatusCategory(object $externalClientStatus, ClientStatus $clientStatus): void
    {
        if (!empty($externalClientStatus->category)) {
            $clientStatusCategory = $this->findClientStatusCategory(type: $externalClientStatus->category);

            if ($clientStatusCategory) {
                $this->addClientStatusCategory(clientStatus: $clientStatus, clientStatusCategory: $clientStatusCategory);
            }
        }
    }

    private function attachClientSubStatus(object $externalClientStatus, ClientStatus $clientStatus): void
    {
        if (!empty($externalClientStatus->reason)) {
            $this->addClientSubStatus(clientStatus: $clientStatus, name: $externalClientStatus->reason);
        }
    }

    private function addClientStatusCategory(ClientStatus $clientStatus, ClientStatusCategory $clientStatusCategory): void
    {
        $this->clientStatusCategoryRepository->attach(clientStatus: $clientStatus, clientStatusCategory: $clientStatusCategory);
    }

    private function findClientStatusCategory(string $type): ?ClientStatusCategory
    {
        return $this->clientStatusCategoryRepository->findByClientAndType(type: $type);
    }

    private function findClients(string $name): Collection
    {
        return $this->clientRepository->allByName(name: $name);
    }

    private function addClientSubStatus(ClientStatus $clientStatus, string $name): void
    {
        $this->clientSubStatusRepository->updateOrCreate(clientStatus: $clientStatus, name: $name);
    }

    private function addClientStatus(Client $client, Crm $crm, string $name): ClientStatus
    {
        return $this->clientStatusRepository->updateOrCreate(client: $client, crm: $crm, name: $name);
    }

    private function addCrm(string $name): Crm
    {
        return $this->crmRepository->updateOrCreate(name: $name);
    }

    private function addClientStatusPreset(Crm $crm, object $externalClientStatus): void
    {
        $this->clientStatusPresetRepository->updateOrCreate(crm: $crm, data: [
            'status' => $externalClientStatus->status,
            'reason' => $externalClientStatus->reason,
            'category' => $externalClientStatus->category
        ]);
    }
}
