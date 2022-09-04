@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('teacher.courses') }}">Cursos</a></li>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <p class="card-form">{{ __('Formulario editar '.$role) }}</p>
                    </div>
                    <div class="card-body">
                        <material-form role="{{ $role }}" edit="{{ $id }}"></material-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>{{ $id->name }}</h5>
                <p>{{ $id->description }}</p>
            </div>
            @if($type === 'homework')
                <score-material id="{{ $id->id }}"></score-material>
            @endif
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row">
            @isset($contents)
            <div class="col-md-2">
                <h6 class="card-title">Lista:</h6>
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

    @if($type === 'activity')
        @isset($role)
        <div class="container">
            <div class="row">
                <h3>{{ __('Listado Tareas') }}</h3>
            </div>
        </div>
        <homework-list id="{{ $id->id }}"></homework-list>
        @endisset
    @endif
@endsection
