<?php

namespace App\Http\Controllers\ClientCategory\Client\Status\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCategory\Client\Status\Category\CreateClientStatusCategoryRequest;
use App\Http\Requests\ClientCategory\Client\Status\Category\UpdateClientStatusCategoryRequest;
use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use App\Models\ClientCategory\ClientCategory;
use App\Repositories\ClientCategory\Client\Status\Category\ClientStatusCategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientStatusCategoryController extends Controller
{
    public function __construct(private ClientStatusCategoryRepository $clientStatusCategoryRepository){}

    public function index(ClientCategory $clientCategory): View
    {
        $clientStatusCategories = $this->clientStatusCategoryRepository->all(clientCategory: $clientCategory);

        return view('pages.client-categories.clients.statuses.categories.index', [
            'clientCategory' => $clientCategory,
            'clientStatusCategories' => $clientStatusCategories
        ]);
    }

    public function store(ClientCategory $clientCategory, CreateClientStatusCategoryRequest $createClientStatusCategoryRequest): RedirectResponse
    {
        $this->clientStatusCategoryRepository->create(clientCategory: $clientCategory, data: $createClientStatusCategoryRequest->validated());

        return redirect()
            ->route('client-categories.status-categories.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Категория статусов клиента успешно добавлена.');
    }

    public function update(
        ClientCategory                      $clientCategory,
        ClientStatusCategory                $clientStatusCategory,
        UpdateClientStatusCategoryRequest   $updateClientStatusCategoryRequest
    ): RedirectResponse
    {
        $this->clientStatusCategoryRepository->update(
            clientCategory: $clientCategory,
            clientStatusCategory: $clientStatusCategory,
            data: $updateClientStatusCategoryRequest->validated()
        );

        return redirect()
            ->route('client-categories.status-categories.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Категория статусов клиента успешно обновлена.');
    }

    public function destroy(ClientCategory $clientCategory, ClientStatusCategory $clientStatusCategory): RedirectResponse
    {
        $this->clientStatusCategoryRepository->delete(clientCategory: $clientCategory, clientStatusCategory: $clientStatusCategory);

        return redirect()
            ->route('client-categories.status-categories.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Категория статусов клиента удалена.');
    }

    public function toggle(ClientCategory $clientCategory, ClientStatusCategory $clientStatusCategory): RedirectResponse
    {
        $this->clientStatusCategoryRepository->toggleActive(clientCategory: $clientCategory, clientStatusCategory: $clientStatusCategory);

        return redirect()
            ->route('client-categories.status-categories.index', ['clientCategory' => $clientCategory])
            ->with('success', 'Активность категории статусов клиента успешно обновлена.');
    }
}
