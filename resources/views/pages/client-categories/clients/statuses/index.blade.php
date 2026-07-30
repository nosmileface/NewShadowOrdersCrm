@extends('layouts.app')

@section('title', 'Статусы клиента: ' . $client->name)

@section('content')

    <div class="layout-container">

        @include('components.aside.aside')

        <div class="layout-page">

            @include('components.nav.nav')

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('client-categories.index') }}">Категории клиентов</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('client-categories.clients.index', $clientCategory->id) }}">{{ $clientCategory->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $client->name }}
                            </li>
                        </ol>
                    </nav>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <h5 class="card-header d-flex justify-content-between align-items-center">
                            <span>Статусы клиента: {{ $client->name }}</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                <i class="tf-icon bx bx-plus"></i> Добавить
                            </button>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table" style="text-align: center">
                                <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>CRM</th>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clientStatuses as $clientStatus)
                                    <tr>
                                        <td>{{ $clientStatus->id }}</td>
                                        <td>{{ $clientStatus->crm->name ?? '—' }}</td>
                                        <td>{{ $clientStatus->name }}</td>
                                        <td>{{ $clientStatus->type }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <button type="button"
                                                        class="btn btn-icon rounded-pill waves-effect"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $clientStatus->id }}">
                                                    <i class="tf-icon bx bx-edit-alt text-secondary"></i>
                                                </button>

                                                <form
                                                    action="{{ route('client-categories.clients.client-statuses.destroy', [$clientCategory->id, $client->id, $clientStatus->id]) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Удалить статус «{{ $clientStatus->name }}»?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-icon rounded-pill waves-effect">
                                                        <i class="tf-icon bx bx-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Статусы не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $clientStatuses->links('components.pagination.pagination') }}

                    </div>
                </div>

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

    @include('pages.client-categories.clients.statuses.create', ['clientCategory' => $clientCategory, 'client' => $client, 'crms' => $crms])

    @foreach ($clientStatuses as $clientStatus)
        @include('pages.client-categories.clients.statuses.edit', ['clientCategory' => $clientCategory, 'client' => $client, 'clientStatus' => $clientStatus, 'crms' => $crms])
    @endforeach

@endsection
