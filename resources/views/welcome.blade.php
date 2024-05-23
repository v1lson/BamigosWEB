<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bamigos</title>
        <script src="https://www.youtube.com/iframe_api"></script>
        @vite("resources/css/app.css")
        <script src=" {{asset('js/bienvenida.js')}}"></script>
        <style>
            .card.image-full:before{
                border-radius: 0px;
                background-color: rgba(255, 94, 58, 0.87);
                opacity: 1;
            }
        </style>
    </head>
    <body class="m-0">
        <div class="h-screen overflow-hidden card rounded-none image-full">
            <figure class="bg-principal">
                <video class="w-screen" id="myVideo" width="560" height="315" autoplay muted playsinline>
                    <source src="{{asset("videos/fondo.mp4")}}" type="video/mp4">
                    <img class="w-screen" src="https://sm.ign.com/ign_latam/gallery/c/counter-st/counter-strike-2-screenshots_bzsu.jpg" alt="">
                </video></figure>
            <div class="z-10 text-white rounded-none flex justify-evenly">
               <div class="float-left text-justify w-5/12 h-screen flex flex-col justify-center ml-5">
                   <h1 class="text-7xl font-bold pb-4">BAMIGOS</h1>
                   <p class="bg-texto p-6 rounded-2xl w-">¡Bienvenidos a Bamigos CS2! Si eres un apasionado de CS2 y disfrutas jugando en nuestros servidores, has llegado al lugar adecuado. En Bamigos CS2, nos enorgullece ofrecer una experiencia de juego excepcional y única para todos nuestros jugadores, y estamos emocionados de tenerte como parte de nuestra comunidad.</p>
                   <div class="flex justify-evenly mt-6">
                       <a href="/"><button class="btn border-0 bg-texto text-white w-56 h-14 text-xl">Pagina Principal</button></a>
                       <a href="/reglas"><button class="btn bg-white border-white  text-principal w-56 h-14 text-xl">Reglas</button></a>
                   </div>
                   <a target="_blank" class="mt-10" href="https://www.youtube.com/@Sparkles" title="Youtube de auto del video del fondo">
                       <button>Youtube de Autor</button>
                   </a>
               </div>
                <img class="w-4/12  content-center" src="{{asset("images/Bienvenida.png")}}" alt="">
            </div>
        </div>
    </body>
</html>

