@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Perfil') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __('Perfil') }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Perfil') }}</div>
                    <div class="card-body">

                            <teacher-profile-form id="{{ $id }}"></teacher-profile-form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
