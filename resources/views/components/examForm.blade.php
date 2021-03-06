@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route($role . '.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route($role . '.exam.list') }}">{{ __('exam') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Register') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-between">
            <h3>{{ __('Exam Register') }}</h3>
            <hr class="col-12">
        </div>
    </div>

    <exam-form role="{{ $role }}" edit="{{ $id ?? '' }}"></exam-form>
@endsection
