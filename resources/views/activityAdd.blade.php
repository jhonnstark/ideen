@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @isset($role)
                        <li class="breadcrumb-item"><a href="{{ route('teacher.course.course', $course) }}">Cursos</a></li>
                    @endisset

                    @empty($role)
                        <li class="breadcrumb-item"><a href="{{ route('course.course', $course) }}">{{ __('Cursos') }}</a></li>
                    @endempty
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Register') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __('Register') }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Formulario '.$role) }}</div>
                    <div class="card-body">
                        <material-form role="{{ $role }}" id="{{ $course }}"></material-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
