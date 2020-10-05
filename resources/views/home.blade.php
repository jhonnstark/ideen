@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <h1>Dashboard de alumno</h1>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">

        <div class="row justify-content-center">
            <div class="card col-sm">
                <div class="card-body">
                    <h5 class="card-title">Mi perfil</h5>
                    <p class="card-text">Administración tu perfil.</p>
                    <a href="{{ route('profile') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card col-sm">
                <div class="card-body">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">Ver mis cursos.</p>
                    <a href="{{ route('courses') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

    </div>
@endsection
