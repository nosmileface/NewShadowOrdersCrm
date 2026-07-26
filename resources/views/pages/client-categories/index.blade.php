@extends('layouts.app')

@section('title', 'Категории клиентов')

@section('content')

    <div class="layout-container">

        @include('components.aside.aside')

        <div class="layout-page">

            @include('components.nav.nav')

            <div class="content-wrapper">

                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>

@endsection
