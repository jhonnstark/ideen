<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Constancia de trabajo</title>

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
                margin: 0 50px;
            }
            .logo {
                height: 200px;
            }
            .date {
                text-align: right;
            }
            .date p {
                font-family: sans-serif;
                font-weight: normal;
            }
            .title {
                text-align: justify;
                line-height: 1.5;
            }
            .title p {
                line-height: 1.5;
                font-family: sans-serif;
                font-weight: normal;
                margin: 16px 0;
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
        <div class="logo"></div>
        <div class="date">
            <p>Mexicali Baja California {{ $date }}</p>
        </div>
        <div class="content">
            <h5>A QUIEN CORRESPONDA. - <br>
                PRESENTE
            </h5>
            <div class="title m-b-md">
                <p>
                    Por medio de la presente y con base en los documentos que obran en el Instituto de
                    Educación en Emprendimiento y Negocios, hago constar que el
                    <b>LIC. {{ $name }}</b>
                    se ha desempeñado como docente en el nivel BACHILLERATO de esta institución desde
                    el año de {{ $year }} hasta la fecha, periodo en el cual ha impartido las asignaturas de
                    ALGEBRA, GEOMETRÍA Y TRIGONOMETRÍA, CALCULO INTEGRAL, CALCULO DIFERENCIAL Y PROBABILIDAD Y ESTADÍSTICA.
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
                <p>Lic. Jesús Emmanuel Sánchez Verde</p>
                <p>Coordinador Académico IDEEN</p>
                <p>Instituto de Educación Superior en Emprendimiento y Negocios</p>
            </div>
        </div>
    </div>
    </body>
</html>
