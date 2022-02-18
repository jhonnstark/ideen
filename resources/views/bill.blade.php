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
                margin: 0 50px;
            }
            p {
                font-family: sans-serif;
                font-weight: normal;
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
                <div class="name">
                    <p>NOMBRE:	{{ $user['name'] . ' ' . $user['lastname'] . ' ' . $user['mothers_lastname'] }}</p>
                    <p>Carrera</p>
                </div>
                <div class="folio">
                    <p>Folio: {{ $id }}</p>
                    <p>Fecha: {{ $date }}</p>
                </div>
            </div>
            <div class="recibo">
                <div class="description">
                    <h5>Descripción</h5>
                    <div class="list">
                        <p>{{ $description }}</p>
                    </div>
                    <p>Total</p>
                </div>
                <div class="total">
                    <h5>Importe</h5>
                    <div class="list">
                        <p>$ {{ $price }}</p>
                    </div>
                    <p>$ {{ $total }}</p>
                </div>
                <p>Este recibo no es comprobante fiscal y será canjeable al contar con el número de matrícula</p>
            </div>
            <div class="sign">
                <div class="sign_name"></div>
                <div class="sign_name"></div>
                <div class="logo">
                    <p class="copy">Copia ALUMNO</p>
                </div>
            </div>
        </div>
    </body>
</html>
