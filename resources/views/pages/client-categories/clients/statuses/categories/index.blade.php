@extends('layouts.app')

@section('title', 'Категории статусов — ' . $clientCategory->name)

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
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $clientCategory->name }}
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
                            <span>Категории статусов: {{ $clientCategory->name }}</span>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="tf-icon bx bx-plus"></i> Добавить
                            </button>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table" style="text-align: center">
                                <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Название</th>
                                    <th>Тип</th>
                                    <th>Активность</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clientStatusCategories as $clientStatusCategory)
                                    <tr>
                                        <td>{{ $clientStatusCategory->id }}</td>
                                        <td>{{ $clientStatusCategory->name }}</td>
                                        <td>{{ $clientStatusCategory->type }}</td>
                                        <td>
                                            <form action="{{ route('client-categories.status-categories.toggle', [$clientCategory->id, $clientStatusCategory->id]) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        class="btn btn-icon rounded-pill waves-effect"
                                                        title="{{ $clientStatusCategory->is_active ? 'Активна' : 'Отключена' }}">
                                                    <i class="tf-icon bx {{ $clientStatusCategory->is_active ? 'bx-toggle-right text-success' : 'bx-toggle-left text-danger' }} bx-md"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <button type="button"
                                                        class="btn btn-icon rounded-pill waves-effect"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $clientStatusCategory->id }}">
                                                    <i class="tf-icon bx bx-edit-alt text-secondary"></i>
                                                </button>

                                                <form action="{{ route('client-categories.status-categories.destroy', [$clientCategory->id, $clientStatusCategory->id]) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Удалить категорию статуса «{{ $clientStatusCategory->name }}»?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon rounded-pill waves-effect">
                                                        <i class="tf-icon bx bx-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Категории статусов не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $clientStatusCategories->links('components.pagination.pagination') }}

                    </div>
                </div>

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

    @include('pages.client-categories.clients.statuses.categories.create', ['clientCategory' => $clientCategory])

    @foreach ($clientStatusCategories as $clientStatusCategory)
        @include('pages.client-categories.clients.statuses.categories.edit', ['clientCategory' => $clientCategory, 'clientStatusCategory' => $clientStatusCategory])
    @endforeach

@endsection
