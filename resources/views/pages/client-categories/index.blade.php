@extends('layouts.app')

@section('title', 'Категории клиентов')

@section('content')

    <div class="layout-container">

        @include('components.aside.aside')

        <div class="layout-page">

            @include('components.nav.nav')

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <h5 class="card-header d-flex justify-content-between align-items-center">
                            <span>Категории клиентов</span>
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
                                    <th>Кол-во клиентов</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($clientCategories as $clientCategory)
                                    <tr>
                                        <td>{{ $clientCategory->id }}</td>
                                        <td><a href="{{ route('client-categories.clients.index', $clientCategory->id) }}">{{ $clientCategory->name }}</a></td>
                                        <td>{{ $clientCategory->type }}</td>
                                        <td><a href="{{ route('client-categories.clients.index', $clientCategory->id) }}">{{ $clientCategory->clients_count }}</a></td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-icon rounded-pill waves-effect"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $clientCategory->id }}">
                                                <i class="tf-icon bx bx-edit-alt text-secondary"></i>
                                            </button>

                                            <form action="{{ route('client-categories.destroy', $clientCategory->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Удалить категорию «{{ $clientCategory->name }}»?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon rounded-pill waves-effect">
                                                    <i class="tf-icon bx bx-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Категории не найдены</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $clientCategories->links('components.pagination.pagination') }}

                    </div>
                </div>

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

    @include('pages.client-categories.create')

    @foreach ($clientCategories as $clientCategory)
        @include('pages.client-categories.edit', ['clientCategory' => $clientCategory])
    @endforeach

@endsection
