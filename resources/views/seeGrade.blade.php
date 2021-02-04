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
            <h3>{{ __('Calificación') }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ $exam->name }}</div>
                    <div class="card-body">
                        <p class="card-title">Calificación: {{ $score->mark ?? 'Pendiente' }}</p>
                        <p class="card-subtitle">Empezado: {{ $score->created_at }}</p>
                        <p class="card-subtitle">Entregado: {{ $score->finish_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
