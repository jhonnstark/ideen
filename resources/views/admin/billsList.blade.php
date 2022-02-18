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

        <div class="row justify-content-between">
            <div class="col">
                <p>Nombre: <b>{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</b></p>
                @if($user['payments']['invoice'] === null)
                    <p>Inscripción: <b>$ {{ $user['payments']['signing_up'] }}</b></p>
                @else
                    <p>Folio de Inscripción: <b># {{ $user['payments']['invoice'] }}</b></p>
                @endif
                <p>Descuento: <b>{{ $user['payments']['discount'] }} %</b></p>
            </div>
            <div class="col">
                <p>Mensualidad: <b>$ {{ $user['payments']['price'] }}</b></p>
                <p>Beca: <b>{{ $user['payments']['scholarship'] }} %</b></p>
                <p>Mensualidad Neta: <b>$ {{ $user['payments']['total'] }}</b></p>
            </div>
        </div>
        <hr class="col-12">
    </div>

    <bills-list role="{{ $role }}" id="{{ $id }}" :payment="{{ $user['payments'] }}"></bills-list>
@endsection
