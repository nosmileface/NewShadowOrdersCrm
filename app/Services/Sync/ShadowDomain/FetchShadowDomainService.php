<?php

namespace App\Services\Sync\ShadowDomain;

use Illuminate\Support\Facades\Http;

class FetchShadowDomainService
{
    private const int FETCH_TIMEOUT = 30;

    public function fetchClientCategories(): array
    {
        return $this->fetch(endpoint: config('shadow-domain.shadow_domain_client_categories_url'));
    }

    public function fetchClients(): array
    {
        return $this->fetch(endpoint: config('shadow-domain.shadow_domain_clients_url'));
    }

    private function fetch(string $endpoint): array
    {
        $response = Http::timeout(self::FETCH_TIMEOUT)
            ->withToken(config('shadow-domain.shadow_domain_api_token'))
            ->acceptJson()
            ->get(config('shadow-domain.shadow_domain_url') . '/api/' . $endpoint);

        return $response->json() ?? [];
    }
}
