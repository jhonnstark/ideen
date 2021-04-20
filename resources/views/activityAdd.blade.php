@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if($role === 'activity')
                        <li class="breadcrumb-item"><a href="{{ route('teacher.course.course', $course) }}">Cursos</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('course.module.activityMaterial', $course) }}">{{ __('Actividades') }}</a></li>
                    @endif
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
