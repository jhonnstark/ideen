@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-between">
            <nav aria-label="breadcrumb col-9">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.' . $role. '.list', $id) }}">{{ __($role) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lista</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-between">
            <h3>{{ __('Listado '.$role) }}</h3>
            <hr class="col-12">
        </div>

        @isset($user['payments'])
            <div class="row justify-content-between">
                <div class="col">
                    <p>Nombre: <b>{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</b></p>
                    @if($user['payments']['invoice'] === null)
                        <p>Inscripción: <b>$ {{ money_format('%n', $user['payments']['signing_up']) }}</b></p>
                    @else
                        <p>Folio de Inscripción: <b># {{ $user['payments']['invoice'] }}</b></p>
                    @endif
                    <p>Descuento: <b>{{ $user['payments']['discount'] }} %</b></p>
                </div>
                <div class="col">
                    <p>Mensualidad: <b>$ {{ money_format('%n', $user['payments']['price']) }}</b></p>
                    <p>Beca: <b>{{ $user['payments']['scholarship'] }} %</b></p>
                    <p>Mensualidad Neta: <b>$ {{ money_format('%n', $user['payments']['total']) }}</b></p>
                </div>
            </div>
        @endisset
        @if($user['payments'] === null)
            <div class="row justify-content-between">
                <div class="col">
                    <p>Nombre: <b>{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</b></p>
                    <p>No tienes un plan de pagos.</p>
                </div>
            </div>
        @endif
        <hr class="col-12">
    </div>

    @isset($user['payments'])
        <bills-list role="{{ $role }}" id="{{ $id }}" :payment="{{ $user['payments'] }}" type="{{ $type ?? 'admin' }}"></bills-list>
    @endisset
@endsection
