@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.' . $role. '.list') }}">{{ __($role) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lista</li>
                </ol>
            </nav>
            <div class="col-3 text-right">
                <a class="btn btn-primary btn-lg" href="{{ route('admin.' . $role . '.register') }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                    Nuevo
                </a>
            </div>
        </div>

        <div class="row justify-content-between">
            <h3>{{ __('Listado '.$role) }}</h3>
            <hr class="col-12">
        </div>

    </div>

    @if($role == 'course')
        <course-list role="{{ $role }}"></course-list>
    @elseif($role == 'category' || $role == 'level')
        <table-list role="{{ $role }}"></table-list>
    @else
        <admin-list role="{{ $role }}"></admin-list>
    @endif
@endsection
