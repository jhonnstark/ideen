@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @if($role === 'activity' || $role === 'content' || $role === 'module')
                        <li class="breadcrumb-item"><a href="{{ route('admin.course.edit', $course) }}">{{ __('Cursos') }}</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('admin.' . $role. '.list') }}">{{ __($role) }}</a></li>
                    @endif
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
                        <p>{{ __('Formulario '.$role) }}</p>
                    </div>
                    <div class="card-body">
                        @if($role === 'payment')
                            <div class="form-group row">
                                <div class="col-12">
                                    <h5 class="text-center">{{ $name }}</h5>
                                </div>
                            </div>
                        @endif

                        @if($role === 'course')
                            <course-form role="{{ $role }}"></course-form>
                        @elseif($role === 'module')
                            <module-form role="{{ $role }}" id="{{ $course }}"></module-form>
                        @elseif($role === 'category')
                            <table-form role="{{ $role }}"></table-form>
                        @elseif($role === 'level')
                            <level-form role="{{ $role }}"></level-form>
                        @elseif($role === 'activity')
                            <material-form role="{{ $role }}" id="{{ $module }}"></material-form>
                        @elseif($role === 'content')
                            <material-form role="{{ $role }}" id="{{ $module }}"></material-form>
                        @elseif($role === 'payment')
                            <payment-form role="{{ $role }}" id="{{ $id }}" type="{{ $type ?? 'admin' }}"></payment-form>
                        @elseif($role === 'concept')
                            <concept-form role="{{ $role }}"></concept-form>
                        @else
                            <register-form role="{{ $role }}"></register-form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
