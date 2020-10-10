@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route($role === '' ? 'home' : $role . '.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route($role === '' ? 'courses' : $role . '.courses') }}">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Curso') }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ __('Listado Actividades') }}</h3>
            <hr class="col-12">
        </div>
    </div>
    <activity-list role="{{ $role }}" id="{{ $id }}"></activity-list>

    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ __('Listado contenidos') }}</h3>
            <hr class="col-12">
        </div>
    </div>
    <content-list role="{{ $role }}" id="{{ $id }}"></content-list>

@endsection
