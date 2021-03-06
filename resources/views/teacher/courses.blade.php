@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Cursos') }}</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-between">
            <h5>{{ __('Cursos') }}</h5>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
    </div>

    <teacher-class-list id="{{ $id }}"></teacher-class-list>

@endsection
