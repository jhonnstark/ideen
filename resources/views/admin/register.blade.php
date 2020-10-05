@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.' . $role. '.list') }}">{{ __($role) }}</a></li>
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

                        @if($role == 'course')
                            <course-form role="{{ $role }}"></course-form>
                        @elseif($role == 'category' || $role == 'level')
                            <table-form role="{{ $role }}"></table-form>
                        @else
                            <register-form role="{{ $role }}"></register-form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
