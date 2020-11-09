@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <h1>Dashboard</h1>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12 2.5a5.5 5.5 0 00-3.096 10.047 9.005 9.005 0 00-5.9 8.18.75.75 0 001.5.045 7.5 7.5 0 0114.993 0 .75.75 0 101.499-.044 9.005 9.005 0 00-5.9-8.181A5.5 5.5 0 0012 2.5zM8 8a4 4 0 118 0 4 4 0 01-8 0z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Administradores</h5>
                    <p class="card-text">Administración y registro de administradores.</p>
                    <a href="{{ route('admin.admins.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path><path d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Profesores</h5>
                    <p class="card-text">Administración y registro de profesores.</p>
                    <a href="{{ route('admin.teacher.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12.292 2.06a.75.75 0 00-.584 0L.458 6.81a.75.75 0 000 1.38L4.25 9.793v3.803a2.901 2.901 0 00-1.327.757c-.579.58-.923 1.41-.923 2.43v4.5c0 .248.128.486.335.624.06.04.117.073.22.124.124.062.297.138.52.213.448.149 1.09.288 1.925.288s1.477-.14 1.925-.288c.223-.075.396-.15.52-.213a2.11 2.11 0 00.21-.117A.762.762 0 008 21.28v-4.5c0-1.018-.344-1.85-.923-2.428a2.9 2.9 0 00-1.327-.758v-3.17l5.958 2.516a.75.75 0 00.584 0l5.208-2.2v4.003a2.552 2.552 0 01-.079.085 4.057 4.057 0 01-.849.65c-.826.488-2.255 1.021-4.572 1.021-.612 0-1.162-.037-1.654-.1a.75.75 0 00-.192 1.487c.56.072 1.173.113 1.846.113 2.558 0 4.254-.592 5.334-1.23.538-.316.914-.64 1.163-.896a2.84 2.84 0 00.392-.482h.001A.75.75 0 0019 15v-4.892l4.542-1.917a.75.75 0 000-1.382l-11.25-4.75zM5 15c-.377 0-.745.141-1.017.413-.265.265-.483.7-.483 1.368v4.022c.299.105.797.228 1.5.228s1.201-.123 1.5-.228V16.78c0-.669-.218-1.103-.483-1.368A1.431 1.431 0 005 15zm7-3.564L2.678 7.5 12 3.564 21.322 7.5 12 11.436z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Alumnos</h5>
                    <p class="card-text">Administración y registro de alumnos.</p>
                    <a href="{{ route('admin.user.list')  }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">Administración y registro de cursos.</p>
                    <a href="{{ route('admin.course.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

<!--            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M2.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h3.5a.75.75 0 010 1.5h-3.5A1.75 1.75 0 011 13.25V1.75C1 .784 1.784 0 2.75 0h8a1.75 1.75 0 011.508.862.75.75 0 11-1.289.768.25.25 0 00-.219-.13h-8z"></path><path fill-rule="evenodd" d="M8 7a4 4 0 116.49 3.13l.995 4.973a.75.75 0 01-.991.852l-2.409-.876a.25.25 0 00-.17 0l-2.409.876a.75.75 0 01-.991-.852l.994-4.973A3.993 3.993 0 018 7zm4-2.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zm0 6.5a4 4 0 001.104-.154l.649 3.243-1.155-.42c-.386-.14-.81-.14-1.196 0l-1.155.42.649-3.243A4 4 0 0012 11z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Examenes</h5>
                    <p class="card-text">Administración y creación de examenes.</p>
                    <a href="{{ route('admin.exam.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>-->
        </div>

        <div class="row justify-content-center">

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7.75 6.5a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z"></path><path fill-rule="evenodd" d="M2.5 1A1.5 1.5 0 001 2.5v8.44c0 .397.158.779.44 1.06l10.25 10.25a1.5 1.5 0 002.12 0l8.44-8.44a1.5 1.5 0 000-2.12L12 1.44A1.5 1.5 0 0010.94 1H2.5zm0 1.5h8.44l10.25 10.25-8.44 8.44L2.5 10.94V2.5z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Categorías</h5>
                    <p class="card-text">Administración y registro de categorías.</p>
                    <a href="{{ route('admin.category.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Niveles</h5>
                    <p class="card-text">Administración y registro de niveles.</p>
                    <a href="{{ route('admin.level.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>


        </div>
    </div>
@endsection
