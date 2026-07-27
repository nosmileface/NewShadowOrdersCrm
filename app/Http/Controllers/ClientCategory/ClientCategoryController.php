<?php

namespace App\Http\Controllers\ClientCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCategory\CreateClientCategoryRequest;
use App\Http\Requests\ClientCategory\UpdateClientCategoryRequest;
use App\Models\ClientCategory\ClientCategory;
use App\Repositories\ClientCategory\ClientCategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientCategoryController extends Controller
{
    public function __construct(private ClientCategoryRepository $clientCategoryRepository){}

    public function index(): View
    {
        $clientCategories = $this->clientCategoryRepository->all();

        return view('pages.client-categories.index', ['clientCategories' => $clientCategories]);
    }

    public function store(CreateClientCategoryRequest $createClientCategoryRequest): RedirectResponse
    {
        $this->clientCategoryRepository->create(data: $createClientCategoryRequest->validated());

        return redirect()
            ->route('client-categories.index')
            ->with('success', 'Категория клиента успешно добавлена.');
    }

    public function update(ClientCategory $clientCategory, UpdateClientCategoryRequest $updateClientCategoryRequest): RedirectResponse
    {
        $this->clientCategoryRepository->update(clientCategory: $clientCategory, data: $updateClientCategoryRequest->validated());

        return redirect()
            ->route('client-categories.index')
            ->with('success', 'Категория клиента успешно обновлена.');
    }

    public function destroy(ClientCategory $clientCategory): RedirectResponse
    {
        $this->clientCategoryRepository->delete(clientCategory: $clientCategory);

        return redirect()
            ->route('client-categories.index')
            ->with('success', 'Категория клиента успешно удалена.');
    }
}
