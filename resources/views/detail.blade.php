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
                Calificación: {{ $id->score }}
            @endisset
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row">
            @isset($contents)
            <div class="col-md-2">
                    @foreach($contents as $content)
                        <a href="{{ route((isset($role) ? 'teacher.':'') . 'course.'. $type . 'Material', $content['id']) }}">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $content['name'] }}</h5>
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
@endsection
