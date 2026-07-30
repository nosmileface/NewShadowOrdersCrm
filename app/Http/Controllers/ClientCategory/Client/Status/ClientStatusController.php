<?php

namespace App\Http\Controllers\ClientCategory\Client\Status;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCategory\Client\Status\CreateClientStatusRequest;
use App\Http\Requests\ClientCategory\Client\Status\UpdateClientStatusRequest;
use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\Client\Status\ClientStatus;
use App\Models\ClientCategory\ClientCategory;
use App\Repositories\ClientCategory\Client\Status\SubStatus\ClientStatusRepository;
use App\Repositories\ClientCategory\Crm\CrmRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientStatusController extends Controller
{
    public function __construct(
        private ClientStatusRepository $clientStatusRepository,
        private CrmRepository          $crmRepository
    ){}

    public function index(ClientCategory $clientCategory, Client $client): View
    {
        $clientStatuses = $this->clientStatusRepository->all(client: $client);

        $crms = $this->crmRepository->all();

        return view('pages.client-categories.clients.statuses.index', [
            'clientCategory' => $clientCategory,
            'client' => $client,
            'clientStatuses' => $clientStatuses,
            'crms' => $crms
        ]);
    }

    public function create(ClientCategory $clientCategory, Client $client): View
    {
        $crms = $this->crmRepository->all();

        return view('pages.client-categories.clients.statuses.create', [
            'client' => $client,
            'crms' => $crms
        ]);
    }

    public function store(ClientCategory $clientCategory, Client $client, CreateClientStatusRequest $createClientStatusRequest): RedirectResponse
    {
        $this->clientStatusRepository->create(client: $client, data: $createClientStatusRequest->validated());

        return redirect()
            ->route('client-categories.clients.client-statuses.index', [
                'clientCategory' => $clientCategory,
                'client' => $client
            ])
            ->with('success', 'Статус клиента успешно добавлен.');
    }

    public function update(
        ClientCategory              $clientCategory,
        Client                      $client,
        ClientStatus                $clientStatus,
        UpdateClientStatusRequest   $updateClientStatusRequest
    ): RedirectResponse
    {
        $this->clientStatusRepository->update(client: $client, clientStatus: $clientStatus, data: $updateClientStatusRequest->validated());

        return redirect()
            ->route('client-categories.clients.client-statuses.index', [
                'clientCategory' => $clientCategory,
                'client' => $client
            ])
            ->with('success', 'Статус клиента успешно обновлен.');
    }

    public function destroy(ClientCategory $clientCategory, Client $client, ClientStatus $clientStatus): RedirectResponse
    {
        $this->clientStatusRepository->delete(client: $client, clientStatus: $clientStatus);

        return redirect()
            ->route('client-categories.clients.client-statuses.index', [
                'clientCategory' => $clientCategory,
                'client' => $client
            ])
            ->with('success', 'Статус клиента успешно удален.');
    }
}
