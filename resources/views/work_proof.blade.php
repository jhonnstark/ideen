<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Recibo</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

        </style>
    </head>
    <body>

        <div class="wrap">

            <div class="logo">

            </div>
            <div class="date">

            </div>
            <div class="content">
                <h5>Mexicali Baja California {{  }}</h5>
                <div class="title m-b-md">
                    {{ $name }}

                    Por medio de la presente y en virtud de los archivos que obran en esta institución
                    hago constar que la C. EDGAR MICHAEL GARCÍA LARIOS, está inscrito como
                    alumno del Instituto de Educación Superior en Emprendimiento y Negocios
                    IDEEN, y cursa el NOVENO CUATRIMESTRE de la LICENCIATURA EN
                    DERECHO, con número de RVOE-BC-L062-M1/16 en el turno matutino.
                    Sin más por el momento, se extiende la presente para los fines que al interesado
                    convengan.
                    Quedo a sus órdenes en caso de que requieran alguna información adicional.
                </div>
                <h5>Atentamente</h5>
                <div class="sign">

                </div>
            </div>
        </div>
    </body>
</html>
