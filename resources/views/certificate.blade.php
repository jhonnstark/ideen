<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recibo</title>

        <!-- Styles -->
        <style>
            html, body {
                background: no-repeat center/100% 100% url("{{ public_path('img/certificate.png') }}"), #fff;
                color: #000;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .wrap {
                margin: 0 30px;
            }
            .logo {
                height: 200px;
            }
            .date {
                text-align: right;
            }
            .title {
                text-align: justify;
            }
            .sign {
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
                position: absolute;
                right: 0;
                left: 0;
                bottom: 120px;
            }
            .sign p {
                margin: 0;
                font-size: .77em;
            }
            h5, b {
                font-weight: bold;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <div class="logo">

            </div>
            <div class="date">
                <p>Mexicali Baja California {{ $date }}</p>
            </div>
            <div class="content">
                <h5>A QUIEN CORRESPONDA. - <br>
                    PRESENTE
                </h5>
                <div class="title m-b-md">
                    <p>
                        Por medio de la presente y en virtud de los archivos que obran en esta institución
                        hago constar que la <b>C. {{ $name }}</b>, está inscrito como
                        alumno del <b>Instituto de Educación Superior en Emprendimiento y Negocios IDEEN</b>,
                        con número de {{ $user_profile['enrollment'] }} en la <b>LICENCIATURA EN DERECHO</b>.
                    </p>
                    <p>
                        Sin más por el momento, se extiende la presente para los fines que al interesado
                        convengan.
                    </p>
                    <p>
                        Quedo a sus órdenes en caso de que requieran alguna información adicional.
                    </p>
                </div>
                <div class="sign">
                    <h5>Atentamente</h5>
                    <p>Ing. Alejandro Rodríguez Iñiguez</p>
                    <p>Dirección Académica IDEEN</p>
                    <p>Instituto de Educación Superior en Emprendimiento y Negocios</p>
                </div>
            </div>
        </div>
    </body>
</html>
