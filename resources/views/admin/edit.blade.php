@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.' . $role . '.list') }}">{{ __($role) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Editar') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __('Editar') }}</h3>
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
                            <course-form role="{{ $role }}" edit="{{ $id }}"></course-form>
                        @elseif($role == 'category' || $role == 'level')
                            <table-form role="{{ $role }}" edit="{{ $id }}"></table-form>
                        @else
                            <register-form role="{{ $role }}" edit="{{ $id }}"></register-form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-between">
            <h5>{{ __('Cursos') }}</h5>
            <hr class="col-12">
        </div>
    </div>

    @if($role == 'teacher')
        <my-course-list role="{{ $role }}" id="{{ $id }}"></my-course-list>
    @elseif($role == 'user')
        <my-class-list role="{{ $role }}" id="{{ $id }}"></my-class-list>
    @endif

@endsection
