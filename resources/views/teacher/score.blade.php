@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Cursos') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __('Calificar Examen') }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <score-exam id="{{ $id }}"></score-exam>
@endsection
