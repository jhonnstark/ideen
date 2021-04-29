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
            <div class="col-12">
                <h4>{{ $user->name . ' ' . $user->laste_name . ' ' . $user->mothers_lastname }}</h4>
            </div>
            <div class="col-m-6">
                <h5>Actividades</h5>
            </div>
            <div class="col-m-6">
                <h5>Examenes</h5>
            </div>
        </div>
    </div>
@endsection
