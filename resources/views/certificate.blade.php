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
                <h5>Mexicali Baja California {{ $date }}</h5>
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
                <h5>Atentamente</h5>
                <div class="sign">

                </div>
            </div>
        </div>
    </body>
</html>
