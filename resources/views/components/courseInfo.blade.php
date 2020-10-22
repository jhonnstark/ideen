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

    @isset($module)
            <div class="container">
                <div class="row justify-content-between">
                    <h3>{{ __('Listado contenidos') }}</h3>
                    <hr class="col-12">
                </div>
            </div>
            <content-list role="{{ $role }}" id="{{ $id }}"></content-list>
    @endisset

    @isset($name)
    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ $name }}</h3>
            <img src="{{ $img }}" alt="poster {{ $role }}" class="img-fluid poster_big">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ __('Listado modulos') }}</h3>
            <hr class="col-12">
        </div>
    </div>
    <module-list role="{{ $role }}" id="{{ $id }}"></module-list>

    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ __('Listado Actividades') }}</h3>
            <div class="col-3 text-right">
                <a class="btn btn-primary btn-lg" href="{{ route($role === '' ? 'course.createActivity' : $role . '.course.createActivity', $id) }}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                    Nuevo
                </a>
            </div>
            <hr class="col-12">
        </div>
    </div>
    <activity-list role="{{ $role }}" id="{{ $id }}"></activity-list>
    @endisset


@endsection
