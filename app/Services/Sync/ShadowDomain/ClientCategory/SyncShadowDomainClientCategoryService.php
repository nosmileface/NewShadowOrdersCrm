<?php

namespace App\Services\Sync\ShadowDomain\ClientCategory;

use App\Repositories\ClientCategory\ClientCategoryRepository;
use App\Services\Sync\ShadowDomain\FetchShadowDomainService;

readonly class SyncShadowDomainClientCategoryService
{
    public function __construct(
        private ClientCategoryRepository $clientCategoryRepository,
        private FetchShadowDomainService $fetchShadowDomainService
    ){}

    public function sync(): int
    {
        $imported = 0;

        $clientCategories = $this->fetchShadowDomainService->fetchClientCategories();

        foreach ($clientCategories as $clientCategory) {
            $this->clientCategoryRepository->updateOrCreate(data: $clientCategory);

            $imported++;
        }

        return $imported;
    }
}
