<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recibo</title>

        <!-- Styles -->
        <style>
            html, body {
                background: #fff;
                color: #000;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .wrap {
                margin: 20px 50px;
                padding-bottom: 75px;
            }
            .subtitulo {
                text-align: center;
            }
            .subtitulo p {
                font-size: 12px;
                margin: 3px 0;
            }
            .user {
                font-size: 0;
            }
            .user p {
                margin: 0;
                font-size: 12px;
            }
            .datos {
                display: inline-block;
                width: 70%;
                text-transform: uppercase;
                font-size: initial;
            }
            .datos p {
                font-weight: bold;
            }
            .folio {
                display: inline-block;
                width: 30%;
                font-size: initial;
            }
            .recibo {
                width: 100%;
                border-spacing: 0;
            }
            .description {
                width: 80%;
            }
            .import {
                width: 20%;
            }
            .list, .money {
                padding: 6px;
                min-height: 80px;
                box-sizing: border-box;
            }
            .total {
                font-weight: bold;
                text-align: right;
                padding: 1px 6px;
            }
            .money p {
                text-align: right;
            }
            .disclaimer {
                font-size: 11px;
            }
            .sign {
                display: block;
                margin-top: 26px;
                padding-top: 75px;
            }
            .sign_name {
                text-transform: uppercase;
                text-align: center;
                font-size: 14px;
            }
            .sign_signature {
                border-top: 2px dotted #000;
                display: inline-block;
                width: 33%;
                padding-top: 5px;
                margin-right: 8%;
            }
            .logo {
                display: inline-block;
                width: 15%;
            }
            .logo-img {
                width: 100px;
            }
            .copy {
                color: #7d0000;
                font-size: 11px;
                text-align: right;
            }
            table, th, td {
                border: 1px solid black;
            }
            h1 {
                font-size: 18px;
                text-align: center;
                margin: 0;
                color: #046f97;
            }
            h2 {
                font-size: 20px;
                text-align: center;
                margin: 18px 0 12px;
            }
            h5 {
                background: #bcbcbc;
                box-sizing: border-box;
                padding: 3px;
                margin: 0;
                font-weight: bold;
                text-align: center;
            }
            p {
                font-family: sans-serif;
                font-weight: normal;
                margin: 0;
            }
            h1, b {
                font-weight: bold;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <h1>INSTITUTO DE EDUCACIÓN SUPERIOR EN EMPRENDIMIENTO Y NEGOCIOS</h1>
            <div class="subtitulo">
                <p>Blvd. Adolfo López Mateos # 1015, Colonia Industrial, C.P.  21010</p>
                <p>Teléfono:  (686) 488.50.43 / (686) 838.77.97</p>
            </div>
            <h2>Recibo</h2>
            <div class="user">
                <div class="datos">
                    <p class="name">NOMBRE:	{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</p>
                    <p class="carrera">Carrera</p>
                </div>
                <div class="folio">
                    <p><strong>Folio:</strong> {{ $id }}</p>
                    <p><strong>Fecha:</strong> {{ $date }}</p>
                </div>
            </div>

            <table class="recibo">
                <thead>
                    <tr>
                        <th class="description"><h5>Descripción</h5></th>
                        <th class="import"><h5>Importe</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p class="list">{{ $description }}</p>
                        </td>
                        <td>
                            <p class="money">$ {{ money_format('%n', $price) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="total">Total</p>
                        </td>
                        <td>
                            <p class="total">$ {{ money_format('%n', $total) }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="disclaimer">Este recibo no es comprobante fiscal y será canjeable al contar con el número de matrícula</p>
            <div class="sign">
                <div class="sign_signature">
                    <p class="sign_name">EMMANUEL SANCHEZ VERDE <br>COORDINADOR ACADEMICO</p>
                </div>
                <div class="sign_signature">
                    <p class="sign_name">{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}<br>Estudiante</p>
                </div>
                <div class="logo">
                    <img src="{{ public_path('img/logo-ideen.png') }}" class="logo-img" alt="logo">
                    <p class="copy">Copia ALUMNO</p>
                </div>
            </div>
        </div>
        <div class="wrap">
            <h1>INSTITUTO DE EDUCACIÓN SUPERIOR EN EMPRENDIMIENTO Y NEGOCIOS</h1>
            <div class="subtitulo">
                <p>Blvd. Adolfo López Mateos # 1015, Colonia Industrial, C.P.  21010</p>
                <p>Teléfono:  (686) 488.50.43 / (686) 838.77.97</p>
            </div>
            <h2>Recibo</h2>

            <div class="user">
                <div class="datos">
                    <p class="name">NOMBRE:	{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</p>
                    <p class="carrera">Carrera</p>
                </div>
                <div class="folio">
                    <p><strong>Folio:</strong> {{ $id }}</p>
                    <p><strong>Fecha:</strong> {{ $date }}</p>
                </div>
            </div>

            <table class="recibo">
                <thead>
                <tr>
                    <th class="description"><h5>Descripción</h5></th>
                    <th class="import"><h5>Importe</h5></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <p class="list">{{ $description }}</p>
                    </td>
                    <td>
                        <p class="money">$ {{ money_format('%n', $price) }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="total">Total</p>
                    </td>
                    <td>
                        <p class="total">$ {{ money_format('%n', $total) }}</p>
                    </td>
                </tr>
                </tbody>
            </table>

            <p class="disclaimer">Este recibo no es comprobante fiscal y será canjeable al contar con el número de matrícula</p>
            <div class="sign">
                <div class="sign_signature">
                    <p class="sign_name">EMMANUEL SANCHEZ VERDE <br>COORDINADOR ACADEMICO</p>
                </div>
                <div class="sign_signature">
                    <p class="sign_name">{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}<br>Estudiante</p>
                </div>
                <div class="logo">
                    <img src="{{ public_path('img/logo-ideen.png') }}" class="logo-img" alt="logo">
                    <p class="copy">Copia ESCUELA</p>
                </div>
            </div>
        </div>
    </body>
</html>
