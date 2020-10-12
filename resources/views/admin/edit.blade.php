@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @if($role === 'activity' || $role === 'content')
                        <li class="breadcrumb-item"><a href="{{ route('admin.course.list') }}">{{ __($role) }}</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('admin.' . $role . '.list') }}">{{ __($role) }}</a></li>
                    @endif
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
                        @elseif($role == 'activity' || $role == 'content')
                            <material-form role="{{ $role }}" edit="{{ $id }}"></material-form>
                        @else
                            <register-form role="{{ $role }}" edit="{{ $id }}"></register-form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($role == 'activity' || $role == 'content')
        <div class="container">
            <div class="row justify-content-between">
                <hr class="col-12">
                <detail id="{{ $id }}" type="{{ $role }}" edit="{{ $material }}"></detail>
            </div>
        </div>
    @endif

    @if($role == 'teacher' || $role == 'user')
    <div class="container">
        <div class="row justify-content-between">
              <h4>{{ __('Cursos') }}</h4>
            <hr class="col-12">
        </div>
    </div>
    @endif

    @if($role == 'teacher')
        <my-course-list role="{{ $role }}" id="{{ $id }}"></my-course-list>
    @elseif($role == 'user')
        <my-class-list role="{{ $role }}" id="{{ $id }}"></my-class-list>
    @endif


    @if($role == 'course')
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('Contenidos') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.content', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>
        <content-list role="{{ $role }}" id="{{ $id }}"></content-list>


        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('Actividades') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.activity', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="18" height="18" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>

        <activity-list role="{{ $role }}" id="{{ $id }}"></activity-list>
    @endif

@endsection
