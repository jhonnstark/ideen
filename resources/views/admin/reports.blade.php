@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(($type ?? 'admin') . '.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route(($type ?? 'admin') . '.reports.list') }}">{{ __('Reportes') }}</a></li>
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
                    <div class="card-header">
                        <p>{{ __('Formulario reports') }}</p>
                    </div>
                    <div class="card-body">
                        <reports-form role="{{ $role ?? 'admin' }}"></reports-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
