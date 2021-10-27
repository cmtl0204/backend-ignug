<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICADO</title>
    <style>

    </style>
</head>
<body>
<div class="content">
    <div class="row">
        <div class="col-12 text-center">
            <img src="{!! asset('logo.png') !!}" alt="Imagen PNG alternativa">
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h1 class="text-center bg-info text-white">CERTIFICADO DE REGISTRO EN LA BOLSA DE EMPLEO</h1>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <br>
            <h2 class="text-muted">
                {{$data->name}} {{$data->lastname}}
            </h2>
            <h2 class="text-muted">
                C.I. {{$data->username}}
            </h2>
            <br>
        </div>
        <div class="col-6">

        </div>
    </div>
    <br>
    @yield('content')
    <footer class="text-center text-muted">
        <hr size="3">
        <small><b>Nota de descargo:</b></small>
        <small>La información contenida en este documento es responsabilidad única del titular.</small>
        <small>Cualquier alteración de dicha información puede ocasionar sanciones.
        </small>
    </footer>
    <br>
</div>
</body>
</html>
