@php use App\Http\SourceQuery\SourceQuery; @endphp
@extends("layouts.layout")

@section("contenido")
    <x-layout.carousel />
    <div class="float-right mr-1 w-3/12">
        <img src="{{asset("images/Principal.png")}}" alt="" class="w-8/12">
        <div class="card w-8/12 bg-principal shadow-xl mt-10 mr-10">
            <figure class="pt-10">
                <svg class="w-8/12 h-2/6" fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 535.806 535.807" xml:space="preserve" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M440.956,373.932c-11.934-13.158-26.315-19.584-44.676-19.584h-38.686l-25.398-24.479 c-18.666,15.3-41.31,24.174-65.791,24.174c-22.95,0-44.676-7.956-62.424-21.726l-22.645,21.726h-40.262 c-20.502,0-36.414,7.038-48.96,21.421c-36.414,42.227-30.294,132.498-27.54,160.344h407.592 C474.31,507.654,477.982,415.242,440.956,373.932z"></path> <path d="M160.343,182.376c-7.344,6.12-12.24,15.912-12.24,27.234c0,16.83,11.016,30.6,25.092,33.048 c3.06,25.398,13.464,47.736,29.07,64.26c3.365,3.366,6.731,6.732,10.403,9.486c4.591,3.672,9.486,6.732,14.688,9.486 c11.628,6.119,24.479,9.485,38.25,9.485c13.77,0,26.623-3.366,38.25-9.485c5.202-2.754,10.098-5.814,14.688-9.486 c3.673-2.754,7.038-6.12,10.404-9.486c15.3-16.523,26.01-38.556,28.764-63.954c0.307,0,0.612,0,0.918,0 c16.219,0,29.07-14.994,29.07-33.354c0-11.322-4.896-21.114-12.24-27.234H160.343L160.343,182.376z"></path> <path d="M377.409,118.116c-9.486-31.518-34.578-63.648-66.402-80.172v71.91v9.792c0,0.612,0,0.918,0,1.224 c-0.306,3.366-0.918,6.426-2.447,9.486c-3.979,7.65-11.935,13.158-21.114,13.158h-4.896h-33.66c-8.568,0-16.219-4.59-20.196-11.322 c-1.836-2.754-2.754-5.813-3.366-9.18c-0.306-1.224-0.306-2.142-0.306-3.366v-8.568v-73.44 c-31.824,16.83-56.916,48.96-66.402,80.478l-2.142,6.732h-17.442v38.25h19.278h26.928h11.322h147.493h11.016h41.7v-1.836v-36.414 h-17.22L377.409,118.116z"></path> <path d="M248.777,134.028h38.25c5.508,0,10.098-3.06,12.546-7.65c1.224-2.142,1.836-4.284,1.836-6.732v-2.754V105.57V33.354V22.95 v-3.978c0-2.448-0.612-4.59-1.224-6.732C297.432,5.202,290.394,0,282.438,0h-33.661c-7.344,0-13.464,5.508-14.076,12.546 c0,0.612-0.306,1.224-0.306,1.836v8.568v10.404v73.44v11.628v1.224c0,3.06,0.918,5.814,2.448,8.262 C239.598,131.58,243.881,134.028,248.777,134.028z"></path> </g> </g></svg>
            </figure>
            <div class="card-body items-center text-center">
                <div class="card-actions">
                    <button class="btn bg-white text-texto">Contactar</button>
                </div>
            </div>
        </div>
    </div>
    <div>
       @if($servidores->count() > 0)
            <x-layout.servidores :servidores="$servidores"/>
        @else
          <div class="flex mt-10">
              <img class="mx-auto" src="{{ asset("images/404.png") }}" alt="">
          </div>
       @endif
        <div class="h-full flex flex-wrap justify-evenly w-2/3">
            <x-layout.rating :servidores="$servidores"/>
        </div>
    </div>
@endsection
@section("titulo")
   Bamigos
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
