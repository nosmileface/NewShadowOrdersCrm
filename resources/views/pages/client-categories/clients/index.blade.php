@extends('layouts.app')

@section('title', 'Клиенты — ' . $clientCategory->name)

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
                            <span>Клиенты категории: {{ $clientCategory->name }}</span>
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
                                    <th>Код</th>
                                    <th>Активность</th>
                                    <th>Адрес</th>
                                    <th>Телефон</th>
                                    <th>Юр. лицо</th>
                                    <th>ИНН</th>
                                    <th>ОГРН</th>
                                    <th>КПП</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->code }}</td>
                                        <td>
                                            <form action="{{ route('client-categories.clients.toggle', [$clientCategory->id, $client->id]) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                        class="btn btn-icon rounded-pill waves-effect"
                                                        title="{{ $client->is_active ? 'Активен' : 'Отключён' }}">
                                                    <i class="tf-icon bx {{ $client->is_active ? 'bx-toggle-right text-success' : 'bx-toggle-left text-danger' }} bx-md"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $client->address }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->legal_entity }}</td>
                                        <td>{{ $client->inn }}</td>
                                        <td>{{ $client->ogrn }}</td>
                                        <td>{{ $client->kpp }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <button type="button"
                                                        class="btn btn-icon rounded-pill waves-effect"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $client->id }}">
                                                    <i class="tf-icon bx bx-edit-alt text-secondary"></i>
                                                </button>

                                                <form action="{{ route('client-categories.clients.destroy', [$clientCategory->id, $client->id]) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Удалить клиента «{{ $client->name }}»?')">
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
                                        <td colspan="11" class="text-center">Клиенты не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $clients->links('components.pagination.pagination') }}

                    </div>
                </div>

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

    @include('pages.client-categories.clients.create', ['clientCategory' => $clientCategory])

    @foreach ($clients as $client)
        @include('pages.client-categories.clients.edit', ['clientCategory' => $clientCategory, 'client' => $client])
    @endforeach

@endsection
