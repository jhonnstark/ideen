@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route($role === '' ? 'home' : $role . '.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route($role === '' ? 'courses' : $role . '.courses') }}">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Curso') }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            <h3>{{ __('Detalle de estudiante') }}</h3>
            <hr class="col-12">
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-1">
                <img class="profile__img" src="{{ asset('img/idtech.jpg') }}" alt="{{ $user->email }}">
            </div>
            <div class="col-11">
                <h4>{{ $user->name . ' ' . $user->laste_name . ' ' . $user->mothers_lastname }}</h4>
                <p>{{ $user->email }}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <hr class="col-12">
            <div class="col-md-6">
                <h5 class="profile__title">Actividades</h5>
                <ul>
                    @foreach ($user->homework as $homework)
                        <li>
                            <p>Nombre: {{ $homework->name }}</p>
                            <p>Descripción: {{ $homework->description }}</p>
                            <p><b>Calificación: {{ $homework->score ?? 'Pendiente'}}</b></p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h5 class="profile__title">Examenes</h5>
                <ul>
                    @foreach ($user->score as $score)
                        <li>
                            <p>{{ $score->exam->name }}</p>
                            <p><b>Calificación: {{ $score->mark ?? 'Pendiente' }}</b></p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <result-user activities="{{ $activity }}" grades="{{ $exam }}"></result-user>
    </div>
@endsection
