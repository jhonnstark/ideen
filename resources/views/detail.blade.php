@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @isset($role)
                        <li class="breadcrumb-item"><a href="{{ route('teacher.courses') }}">Cursos</a></li>
                    @endisset

                    @empty($role)
                        <li class="breadcrumb-item"><a href="{{ route('courses') }}">Cursos</a></li>
                    @endempty
                    <li class="breadcrumb-item active" aria-current="page">{{ __($type) }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __($type) }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>{{ $id->name }}</h5>
                <p>{{ $id->description }}</p>
            </div>
            @isset($role)
                <score-material id="{{ $id->id }}"></score-material>
            @else
                <div class="col-md-3">
                    <h4>Calificación: {{ $id->score }}</h4>
                </div>
                @empty($contents)
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('course.module.createHomework', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Cargar tarea
                    </a>
                </div>
                @endempty
            @endisset


            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row">
            @isset($contents)
            <div class="col-md-2">
                <h6 class="card-title">Actividades:</h6>
                @foreach($contents as $content)
                    <a href="{{ route((isset($role) ? 'teacher.':'') . 'course.module.'. $type . 'Material', $content['id']) }}">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-activity">{{ $content['name'] }}</h6>
                                <p class="card-text">{{ $content['description'] }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @endisset
            <detail id="{{ $id }}" type="{{ $type }}"></detail>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h3>{{ __('Listado Tareas') }}</h3>
        </div>
    </div>
    <homework-list id="{{ $id->id }}"></homework-list>
@endsection
