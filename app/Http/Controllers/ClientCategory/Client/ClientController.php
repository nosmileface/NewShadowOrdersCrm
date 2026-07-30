<?php

namespace App\Http\Controllers\ClientCategory\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCategory\Client\CreateClientRequest;
use App\Http\Requests\ClientCategory\Client\UpdateClientRequest;
use App\Models\ClientCategory\Client\Client;
use App\Models\ClientCategory\ClientCategory;
use App\Repositories\ClientCategory\Client\ClientRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(private ClientRepository $clientRepository){}

    public function index(ClientCategory $clientCategory): View
    {
        $clients = $this->clientRepository->all(clientCategory: $clientCategory);

        return view('pages.client-categories.clients.index', [
            'clientCategory' => $clientCategory,
            'clients' => $clients
        ]);
    }

    public function store(ClientCategory $clientCategory, CreateClientRequest $createClientRequest): RedirectResponse
    {
        $this->clientRepository->create(clientCategory: $clientCategory, data: $createClientRequest->validated());

        return redirect()
            ->route('client-categories.clients.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Клиент успешно добавлен.');
    }

    public function update(ClientCategory $clientCategory, Client $client, UpdateClientRequest $updateClientRequest): RedirectResponse
    {
        $this->clientRepository->update(clientCategory: $clientCategory, client: $client, data: $updateClientRequest->validated());

        return redirect()
            ->route('client-categories.clients.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Клиент успешно обновлен.');
    }

    public function destroy(ClientCategory $clientCategory, Client $client): RedirectResponse
    {
        $this->clientRepository->delete(clientCategory: $clientCategory, client: $client);

        return redirect()
            ->route('client-categories.clients.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Клиент успешно удален.');
    }

    public function toggle(ClientCategory $clientCategory, Client $client): RedirectResponse
    {
        $this->clientRepository->toggleActive(clientCategory: $clientCategory, client: $client);

        return redirect()
            ->route('client-categories.clients.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Активность клиента успешно обновлен.');
    }
}
