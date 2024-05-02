@php use App\Http\SourceQuery\SourceQuery; @endphp
@extends("layouts.layout")

@section("contenido")
    <x-layout.carousel />
    <img src="{{asset("images/Principal.png")}}" alt="" class="w-2/12 float-right mr-10">
    <div>
        <x-layout.servidores :servidores="$servidores"/>
        @auth
      @if(auth()->user()->rol == 1)
            <div class="h-full flex flex-wrap justify-evenly w-2/3">
                <x-layout.rating :servidores="$servidores"/>
            </div>
      @endif
        @endauth
    </div>
@endsection
@section("titulo")
    proyecto laravel
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
