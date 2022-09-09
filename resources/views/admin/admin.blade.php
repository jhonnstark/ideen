@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <h1>Dashboard de Administrador</h1>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-sm">
                <div class="card-body">
                    <h5 class="card-title">Mi perfil</h5>
                    <p class="card-text">Administración tu perfil.</p>
                    <a href="{{ route('admin.profile') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gap-10">
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
                    <svg width="24" height="24" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1024 1131q0 64-37 106.5t-91 42.5h-512q-54 0-91-42.5t-37-106.5 9-117.5 29.5-103 60.5-78 97-28.5q6 4 30 18t37.5 21.5 35.5 17.5 43 14.5 42 4.5 42-4.5 43-14.5 35.5-17.5 37.5-21.5 30-18q57 0 97 28.5t60.5 78 29.5 103 9 117.5zm-157-520q0 94-66.5 160.5t-160.5 66.5-160.5-66.5-66.5-160.5 66.5-160.5 160.5-66.5 160.5 66.5 66.5 160.5zm925 445v64q0 14-9 23t-23 9h-576q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h576q14 0 23 9t9 23zm0-252v56q0 15-10.5 25.5t-25.5 10.5h-568q-15 0-25.5-10.5t-10.5-25.5v-56q0-15 10.5-25.5t25.5-10.5h568q15 0 25.5 10.5t10.5 25.5zm0-260v64q0 14-9 23t-23 9h-576q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h576q14 0 23 9t9 23zm128 960v-1216q0-13-9.5-22.5t-22.5-9.5h-1728q-13 0-22.5 9.5t-9.5 22.5v1216q0 13 9.5 22.5t22.5 9.5h352v-96q0-14 9-23t23-9h64q14 0 23 9t9 23v96h768v-96q0-14 9-23t23-9h64q14 0 23 9t9 23v96h352q13 0 22.5-9.5t9.5-22.5zm128-1216v1216q0 66-47 113t-113 47h-1728q-66 0-113-47t-47-113v-1216q0-66 47-113t113-47h1728q66 0 113 47t47 113z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Servicios escolares</h5>
                    <p class="card-text">Administración y registro de usuarios de servicio escolar.</p>
                    <a href="{{ route('admin.personnels.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="24" height="24" viewBox="0 0 2304 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1728 448l-384 704h768zm-1280 0l-384 704h768zm821-192q-14 40-45.5 71.5t-71.5 45.5v1291h608q14 0 23 9t9 23v64q0 14-9 23t-23 9h-1344q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h608v-1291q-40-14-71.5-45.5t-45.5-71.5h-491q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h491q21-57 70-92.5t111-35.5 111 35.5 70 92.5h491q14 0 23 9t9 23v64q0 14-9 23t-23 9h-491zm-181 16q33 0 56.5-23.5t23.5-56.5-23.5-56.5-56.5-23.5-56.5 23.5-23.5 56.5 23.5 56.5 56.5 23.5zm1088 880q0 73-46.5 131t-117.5 91-144.5 49.5-139.5 16.5-139.5-16.5-144.5-49.5-117.5-91-46.5-131q0-11 35-81t92-174.5 107-195.5 102-184 56-100q18-33 56-33t56 33q4 7 56 100t102 184 107 195.5 92 174.5 35 81zm-1280 0q0 73-46.5 131t-117.5 91-144.5 49.5-139.5 16.5-139.5-16.5-144.5-49.5-117.5-91-46.5-131q0-11 35-81t92-174.5 107-195.5 102-184 56-100q18-33 56-33t56 33q4 7 56 100t102 184 107 195.5 92 174.5 35 81z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Cobranza</h5>
                    <p class="card-text">Administración y registro de usuarios de cobranza.</p>
                    <a href="{{ route('admin.finances.list')  }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gap-10">

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

        <div class="row justify-content-center gap-10">
            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_channel_24_regular" fill="#212121" fill-rule="nonzero">
                                <path d="M17.75,3 C19.4830315,3 20.8992459,4.35645477 20.9948552,6.06557609 L21,6.25 L21,17.75 C21,19.4830315 19.6435452,20.8992459 17.9344239,20.9948552 L17.75,21 L6.25,21 C4.51696854,21 3.10075407,19.6435452 3.00514479,17.9344239 L3,17.75 L2.99971265,9.37207838 C3.23437906,9.45505284 3.48691683,9.50020306 3.75,9.50020306 C4.0130526,9.50020306 4.26556225,9.45506334 4.50020555,9.3721073 L4.5,17.75 C4.5,18.6681734 5.20711027,19.4211923 6.10647279,19.4941988 L6.25,19.5 L17.75,19.5 C18.6681734,19.5 19.4211923,18.7928897 19.4941988,17.8935272 L19.5,17.75 L19.5,6.25 C19.5,5.3318266 18.7928897,4.57880766 17.8935272,4.5058012 L17.75,4.5 L6.25,4.5 C5.64982181,4.5 5.12021056,4.802133 4.80496463,5.26260061 C4.49104253,5.09500047 4.13161554,5 3.75,5 C3.56877339,5 3.39255082,5.02142484 3.22372699,5.06187982 C3.67701189,3.90898676 4.76996387,3.07762212 6.06557609,3.00514479 L6.25,3 L17.75,3 Z M13.246023,13.003051 C13.6602366,13.003051 13.996023,13.3388374 13.996023,13.753051 C13.996023,14.1327468 13.7138691,14.446542 13.3477936,14.4962044 L13.246023,14.503051 L8.74776,14.503051 C8.33354644,14.503051 7.99776,14.1672646 7.99776,13.753051 C7.99776,13.3733552 8.27991388,13.05956 8.64598944,13.0098976 L8.74776,13.003051 L13.246023,13.003051 Z M15.25224,9.49622796 C15.6664536,9.49622796 16.00224,9.83201439 16.00224,10.246228 C16.00224,10.6259237 15.7200861,10.9397189 15.3540106,10.9893813 L15.25224,10.996228 L8.74776,10.996228 C8.33354644,10.996228 7.99776,10.6604415 7.99776,10.246228 C7.99776,9.86653219 8.27991388,9.552737 8.64598944,9.50307457 L8.74776,9.49622796 L15.25224,9.49622796 Z M3.75,6 C4.44041201,6 5.00010153,6.55968952 5.00010153,7.25010153 C5.00010153,7.94051354 4.44041201,8.50020306 3.75,8.50020306 C3.05958799,8.50020306 2.49989847,7.94051354 2.49989847,7.25010153 C2.49989847,6.55968952 3.05958799,6 3.75,6 Z" id="🎨-Color"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Programas</h5>
                    <p class="card-text">Administración y registro de programas.</p>
                    <a href="{{ route('admin.program.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"><g><path d="M56.699,48.02c-0.55-0.104-1.069,0.24-1.18,0.781C54.403,54.303,50.074,58,44.749,58c-5.028,0-9.446-3.3-10.948-8H38.5v-2h-8v8h2v-3.848C34.669,56.833,39.415,60,44.749,60c6.304,0,11.42-4.341,12.731-10.801C57.59,48.657,57.24,48.13,56.699,48.02z"/><path d="M56.5,36v4.308C54.25,35.855,49.796,33,44.749,33c-6.109,0-11.541,3.997-13.209,9.721c-0.154,0.53,0.15,1.085,0.681,1.239c0.529,0.154,1.085-0.15,1.239-0.681C34.858,38.482,39.605,35,44.749,35c4.565,0,8.562,2.766,10.33,7H50.5v2h8v-8H56.5z"/><path d="M37.5,32h9V21h-9h-2h-7h-2h-7h-2h-9v9v2v7v2v9h9h2h9v-9v-2v-7h7H37.5z M37.5,23h7v7h-7V23z M19.5,23h7v7h-7V23z M10.5,23h7v7h-7V23z M10.5,32h7v7h-7V32z M17.5,48h-7v-7h7V48z M26.5,48h-7v-7h7V48z M26.5,39h-7v-7h7V39z M28.5,30v-7h7v7H28.5z"/><path d="M25.5,55h-22V16h48v13c0,0.553,0.447,1,1,1s1-0.447,1-1V15V5c0-0.553-0.447-1-1-1h-5V1c0-0.553-0.447-1-1-1h-7c-0.553,0-1,0.447-1,1v3h-22V1c0-0.553-0.447-1-1-1h-7c-0.553,0-1,0.447-1,1v3h-5c-0.553,0-1,0.447-1,1v10v41c0,0.553,0.447,1,1,1h23c0.553,0,1-0.447,1-1S26.053,55,25.5,55z M40.5,2h5v3v3h-5V5V2z M9.5,2h5v3v3h-5V5V2z M3.5,6h4v3c0,0.553,0.447,1,1,1h7c0.553,0,1-0.447,1-1V6h22v3c0,0.553,0.447,1,1,1h7c0.553,0,1-0.447,1-1V6h4v8h-48V6z"/></g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Ciclos</h5>
                    <p class="card-text">Administración y registro de ciclos.</p>
                    <a href="{{ route('admin.cycle.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_class_24_regular" fill="#212121" fill-rule="nonzero">
                                <path d="M17.25,2.00051727 C18.7687831,2.00051727 20,3.2317342 20,4.75051727 L20,19.2487649 C20,20.767548 18.7687831,21.9987649 17.25,21.9987649 L6.74990198,21.9987649 C5.23111892,21.9987649 3.99990198,20.767548 3.99990198,19.2487649 L3.99990198,4.75051727 C3.99990198,3.49157857 4.84586671,2.43022552 6.00034646,2.10390783 L5.99952861,3.75070628 C5.69612931,3.97877502 5.49990198,4.34173047 5.49990198,4.75051727 L5.49990198,19.2487649 C5.49990198,19.9391209 6.05954604,20.4987649 6.74990198,20.4987649 L17.25,20.4987649 C17.9403559,20.4987649 18.5,19.9391209 18.5,19.2487649 L18.5,4.75051727 C18.5,4.06016133 17.9403559,3.50051727 17.25,3.50051727 L14.999902,3.5 L14.999902,2 L17.25,2.00051727 Z M14,2 L14,10.1388813 C14,10.886029 13.2005853,11.1665265 12.7107881,10.9033076 L12.627793,10.8511974 L10.5018161,9.56574729 L8.42369491,10.8171712 C7.92400815,11.1778695 7.09332026,10.9563947 7.00726361,10.259427 L7,10.1388813 L7,2 L14,2 Z M12.5,3.5 L8.5,3.5 L8.5,9.02327267 L10.0732768,8.07420697 C10.337571,7.93602315 10.6573451,7.93340934 10.8905006,8.05035601 L12.5,9.02395569 L12.5,3.5 Z" id="🎨Color"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Materias</h5>
                    <p class="card-text">Administración y registro de materias.</p>
                    <a href="{{ route('admin.subject.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gap-10">
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

        <div class="row justify-content-center gap-10">
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

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="52px" height="52px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve"><g><path d="M15.9,28c-1.4-2.1-2.1-4.5-2.1-7.2c0-4.6,1.9-8.4,4.9-10.7c-1-1.8-3-3.1-5.6-3.1c-4.4,0-6.9,3.6-6.9,7.7c0,2.2,0.7,4.1,2.2,5.4c0.8,0.8,1.5,1.8,1.5,2.8S9.5,24.9,7,26c-3.6,1.6-6.9,3.8-7,7.1C0.1,35.3,1.5,37,3.6,37h3.3c0.5,0,1-0.3,1.3-0.8c1.6-2.9,4.6-4.7,7.1-6C16.2,29.8,16.4,28.7,15.9,28z"/><path d="M45.1,26c-2.5-1.1-2.9-2-2.9-3.1s0.7-2.1,1.5-2.8c1.5-1.4,2.2-3.2,2.2-5.4c0-4.1-2.4-7.7-6.9-7.7c-2.6,0-4.6,1.3-5.7,3.1c3,2.3,4.9,6.1,4.9,10.7c0,2.7-0.7,5.1-2.1,7.2c-0.5,0.8-0.2,1.8,0.6,2.2c2.5,1.2,5.5,3.1,7.1,6c0.3,0.5,0.8,0.8,1.3,0.8h3.3c2.1,0,3.5-1.7,3.5-3.9C52,29.8,48.7,27.6,45.1,26z"/><path d="M32.7,33.3c-2.7-1.2-3.2-2.3-3.2-3.4c0-1.2,0.8-2.3,1.7-3.1c1.6-1.5,2.5-3.6,2.5-6c0-4.5-2.7-8.4-7.6-8.4s-7.6,3.9-7.6,8.4c0,2.4,0.9,4.5,2.5,6c0.9,0.9,1.7,2,1.7,3.1c0,1.2-0.4,2.2-3.2,3.4c-4,1.7-7.8,3.6-7.9,7.2c0,2.4,1.8,4.4,4.1,4.4h10.4h10.4c2.3,0,4.1-2,4.1-4.4C40.5,37,36.7,35.1,32.7,33.3z"/></g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Grupos</h5>
                    <p class="card-text">Administración y registro de grupos.</p>
                    <a href="{{ route('admin.group.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M2.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h3.5a.75.75 0 010 1.5h-3.5A1.75 1.75 0 011 13.25V1.75C1 .784 1.784 0 2.75 0h8a1.75 1.75 0 011.508.862.75.75 0 11-1.289.768.25.25 0 00-.219-.13h-8z"></path><path fill-rule="evenodd" d="M8 7a4 4 0 116.49 3.13l.995 4.973a.75.75 0 01-.991.852l-2.409-.876a.25.25 0 00-.17 0l-2.409.876a.75.75 0 01-.991-.852l.994-4.973A3.993 3.993 0 018 7zm4-2.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zm0 6.5a4 4 0 001.104-.154l.649 3.243-1.155-.42c-.386-.14-.81-.14-1.196 0l-1.155.42.649-3.243A4 4 0 0012 11z"></path></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Examenes</h5>
                    <p class="card-text">Administración y creación de examenes.</p>
                    <a href="{{ route('admin.exam.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

        </div>

        <div class="row justify-content-center gap-10">
            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100.75 100.748" style="enable-background:new 0 0 100.75 100.748;" xml:space="preserve"><g><path d="M17.313,56.946c0-0.803-0.65-1.453-1.453-1.453s-1.453,0.65-1.453,1.453c0,4.053,3.59,7.411,8.252,7.996v6.205c0,0.803,0.65,1.453,1.453,1.453s1.453-0.65,1.453-1.453V64.94c4.656-0.592,8.238-3.946,8.238-7.993
		c0-4.045-3.583-7.395-8.238-7.986V38.614c3.045,0.51,5.332,2.585,5.332,5.064c0,0.803,0.65,1.453,1.453,1.453s1.453-0.65,1.453-1.453c0-4.049-3.583-7.403-8.238-7.992v-6.213c0-0.803-0.65-1.453-1.453-1.453s-1.453,0.65-1.453,1.453v6.213
		c-4.663,0.588-8.252,3.942-8.252,7.992c0,4.046,3.589,7.399,8.252,7.985v10.352C19.607,61.507,17.313,59.429,17.313,56.946z
		 M30.897,56.946c0,2.477-2.287,4.552-5.332,5.065V51.888C28.61,52.4,30.897,54.472,30.897,56.946z M17.313,43.678
		c0-2.479,2.293-4.555,5.346-5.064v10.122C19.606,48.227,17.313,46.154,17.313,43.678z"/><path d="M96.51,20.412H3.492c-0.803,0-1.453,0.65-1.453,1.453v59.19c0,0.803,0.65,1.453,1.453,1.453H96.51
		c0.803,0,1.453-0.65,1.453-1.453v-59.19C97.963,21.062,97.312,20.412,96.51,20.412z M95.057,79.602H4.945V23.318h90.111V79.602z"/><path d="M45.77,40.236h42.282c0.803,0,1.453-0.65,1.453-1.453s-0.65-1.453-1.453-1.453H45.77c-0.803,0-1.453,0.65-1.453,1.453
		S44.967,40.236,45.77,40.236z"/><path d="M45.77,51.762h42.282c0.803,0,1.453-0.65,1.453-1.453c0-0.803-0.65-1.453-1.453-1.453H45.77
		c-0.803,0-1.453,0.65-1.453,1.453C44.317,51.111,44.967,51.762,45.77,51.762z"/><path d="M45.77,65.583h42.282c0.803,0,1.453-0.65,1.453-1.453s-0.65-1.453-1.453-1.453H45.77c-0.803,0-1.453,0.65-1.453,1.453
		S44.967,65.583,45.77,65.583z"/></g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pagos y recibos</h5>
                    <p class="card-text">Administración de pagos y creacion de recibos.</p>
                    <a href="{{ route('admin.payment.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M63 1536h-63v-1408h63v1408zm63-1h-32v-1407h32v1407zm94 0h-31v-1407h31v1407zm157 0h-31v-1407h31v1407zm157 0h-62v-1407h62v1407zm126 0h-31v-1407h31v1407zm63 0h-31v-1407h31v1407zm63 0h-31v-1407h31v1407zm157 0h-63v-1407h63v1407zm157 0h-63v-1407h63v1407zm126 0h-63v-1407h63v1407zm126 0h-63v-1407h63v1407zm94 0h-63v-1407h63v1407zm189 0h-94v-1407h94v1407zm63 0h-32v-1407h32v1407zm94 1h-63v-1408h63v1408z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Conceptos de pagos extras</h5>
                    <p class="card-text">Administración de pagos y creacion de conceptos.</p>
                    <a href="{{ route('admin.concept.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="2048" height="1792" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1024 512h-384v384h384v-384zm128 640v128h-640v-128h640zm0-768v640h-640v-640h640zm640 768v128h-512v-128h512zm0-256v128h-512v-128h512zm0-256v128h-512v-128h512zm0-256v128h-512v-128h512zm-1536 960v-960h-128v960q0 26 19 45t45 19 45-19 19-45zm1664 0v-1088h-1536v1088q0 33-11 64h1483q26 0 45-19t19-45zm128-1216v1216q0 80-56 136t-136 56h-1664q-80 0-136-56t-56-136v-1088h256v-128h1792z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Reportes de cobranza</h5>
                    <p class="card-text">Generación de reportes.</p>
                    <a href="{{ route('admin.reports.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
