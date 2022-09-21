@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @if($role === 'activity' || $role === 'content' || $role === 'module')
                        <li class="breadcrumb-item"><a href="{{ route('admin.course.list') }}">{{ __('course') }}</a></li>
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
                    <div class="card-header">
                        <p class="card-form">{{ __('Formulario editar '.$role) }}</p>
                    </div>
                    <div class="card-body">
                        @if($role === 'course')
                            <course-form role="{{ $role }}" edit="{{ $id }}"></course-form>
                        @elseif($role === 'module')
                            <module-form role="{{ $role }}" edit="{{ $id }}"></module-form>
                        @elseif($role === 'category')
                            <table-form role="{{ $role }}" edit="{{ $id }}"></table-form>
                        @elseif($role === 'level')
                            <level-form role="{{ $role }}" edit="{{ $id }}"></level-form>
                        @elseif($role === 'activity' || $role === 'content')
                            <material-form role="{{ $role }}" edit="{{ $id }}"></material-form>
                        @elseif($role === 'program')
                            <program-form role="{{ $role }}" edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></program-form>
                        @elseif($role === 'cycle')
                            <cycle-form role="{{ $role }}" edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></cycle-form>
                        @elseif($role === 'subject')
                            <subject-form role="{{ $role }}" edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></subject-form>
                        @elseif($role === 'group')
                            <group-form role="{{ $role }}" edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></group-form>
                        @elseif($role === 'concept')
                            <concept-form role="{{ $role }} edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></concept-form>
                        @else
                            <register-form role="{{ $role }}" edit="{{ $id }}" type="{{ $type ?? 'admin' }}"></register-form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($role === 'activity' || $role === 'content')
        <div class="container">
            <div class="row justify-content-center">
                <hr class="col-12">
                <detail id="{{ $id }}" type="{{ $role }}" edit="material"></detail>
            </div>
        </div>
        @isset($activity)
            <div class="container">
                <div class="row">
                    <h3>{{ __('Listado homework') }}</h3>
                </div>
            </div>
            <homework-list id="{{ $activity }}"></homework-list>
        @endisset
    @endif

    @if($role === 'teacher' || $role === 'user' || $role === 'level')
    <div class="container">
        <div class="row justify-content-between">
            <h4>{{ __('course') }}</h4>
            @if($role === 'level')
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.register', ['level' => $id]) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="21" height="21" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
            @endif
            <hr class="col-12">
        </div>
    </div>
    @endif

    @if($role === 'teacher' || $role === 'level')
        <my-course-list role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></my-course-list>
    @elseif($role === 'user')
        <user-courses role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></user-courses>
        <div class="container">
            <div class="row justify-content-between">
                <h4>{{ __('group') }}</h4>
                <hr class="col-12">
            </div>
        </div>
        <user-groups role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></user-groups>
    @endif

    @if($role === 'teacher')
        <div class="container">
            <div class="row justify-content-between">
                <h4>{{ __('group') }}</h4>
                <hr class="col-12">
            </div>
        </div>
        <teacher-groups role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></teacher-groups>
    @endif

    @if($role === 'program')
        <div class="container">
            <div class="row justify-content-between">
                <h4>{{ __('subject') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route(($type ?? 'admin').'.subject.register', ['program' => $id]) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="21" height="21" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>
        <subject-list program="{{ $id }}" type="{{ $type ?? 'admin' }}"></subject-list>
    @endif

    @if($role === 'module')
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('content') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.content', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="21" height="21" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>
        <content-list role="{{ $role }}" id="{{ $id }}"></content-list>
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('activity') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.activity', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="21" height="21" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>
        <activity-list role="{{ $role }}" id="{{ $id }}"></activity-list>
    @endif

    @if($role === 'course')
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('module') }}</h4>
                <div class="col-3 text-right">
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.course.module', $id) }}" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="21" height="21" fill="white"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.75 4.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"></path></svg>
                        Nuevo
                    </a>
                </div>
                <hr class="col-12">
            </div>
        </div>
        <module-list role="{{ $role }}" id="{{ $id }}"></module-list>
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('Listado user') }}</h4>
                <hr class="col-12">
            </div>
        </div>
        <student-list role="{{ $role }}" id="{{ $id }}"></student-list>
    @endif

    @if($role === 'group')
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('Listado user') }}</h4>
                <hr class="col-12">
            </div>
        </div>
        <group-users role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></group-users>
        <div class="container">
            <div class="row justify-content-between">
                <h4 class="col-9">{{ __('Listado teacher') }}</h4>
                <hr class="col-12">
            </div>
        </div>
        <group-teachers role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></group-teachers>
    @endif

@endsection
