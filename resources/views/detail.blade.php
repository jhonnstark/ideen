@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('courses') }}">Cursos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __($type) }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __($type) }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <detail id="{{ $id }}"></detail>
@endsection
