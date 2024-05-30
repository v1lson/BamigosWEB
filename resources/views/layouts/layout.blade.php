<!doctype html>
<html lang="en" data-theme="light" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="¡Bamigos es tu destino definitivo para encontrar los mejores servidores de Counter-Strike! ¡Únete a nuestra comunidad ahora y disfruta de juegos emocionantes con amigos!">
    <meta name="keywords" content="Counter-Strike, CS, servidores de CS, juegos en línea, comunidad de juegos, amigos, Bamigos">
    <meta name="author" content="Equipo Bamigos">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" sizes="265x205" href="{{ asset('favicon.png') }}" type="image/png">
    <title>@yield("titulo")</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
     @vite("resources/css/app.css")
    <script src=" {{asset('js/bienvenida.js')}}"></script>
    <script src=" {{asset('js/navscroll.js')}}"></script>
    <style>
      .clearfix::after {
   	 content: "";
    	clear: both;
    	display: table;
      } 
    </style>
    @yield("cabecera")
</head>
<body class="bg-fondo min-h-screen">

<x-layout.header />

<x-layout.nav />

<main class="ml-0 sm:ml-64 mt-10 mr-12 h-100vh clearfix">
    @yield("contenido")
</main>

</body>
</html>
