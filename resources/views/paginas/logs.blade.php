@php
    use App\Models\RolUser;use App\Models\Servidor;use App\Http\SourceQuery\SourceQuery;use App\Http\SourceQuery\SourceRcon;
    $auth = false;
     if (!auth()->guest()){
          if (strpos(RolUser::select('flags')->where('id',auth()->user()->rol)->value('flags'), 'l')){
               $auth = true;
          }
     }
     if (!$auth){
        echo "<script>window.location = '/';</script>";
        exit;
    }
@endphp
@extends("layouts.layout")
@section("cabecera")
    <style>
        .scrollable-div {
            height: 70vh; /* Altura máxima antes de activar el scroll */
            overflow-y: auto; /* Agrega scroll vertical cuando el contenido excede la altura */
            border: 1px solid #ccc; /* Borde para mejorar la visualización */
        }
    </style>
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Logs</h2>
    <form class="mt-5 flex flex-row justify-end" action="{{ route('est', ['id_servidor' => session('id_servidor'), 'order_by' => 'value', 'orden' => 'desc']) }}" method="GET">
        <select class="select mr-3"  name="" id="">
            <option value="" selected>Sin Tipo</option>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>
            @endforeach
        </select>
        <label for="desde" class="mr-2 mt-auto mb-auto font-bold">Desde: </label>
        <input type="datetime-local" id="desde" name="desde" class="input mr-3" value="<?php if(isset($nombreBusqeuda)){echo $nombreBusqeuda ? : '';}?>"/>
        <label for="hasta" class="mr-2 mt-auto mb-auto font-bold">Hasta: </label>
        <input type="datetime-local" id="hasta" name="hasta" class="input mr-3" value="<?php if(isset($nombreBusqeuda)){echo $nombreBusqeuda ? : '';}?>"/>
        <input type="text" name="nombre" class="input mr-3" placeholder="Nombre" value="<?php if(isset($nombreBusqeuda)){echo $nombreBusqeuda ? : '';}?>"/>
        <input type="text" name="steamId" class="input" placeholder="Steam ID" value="<?php if(isset($steamId)){echo $steamId ? : '';}?>"/>
        <input class="btn bg-principal text-white ml-2" type="submit" value="Buscar">
    </form>
    <div class="float-left">
        <ul class="menu bg-white w-56 rounded-box mt-5">
            @foreach($servidores as $servidor)
                @if(session('id_servidor') ==  $servidor->id)
                    <li class=""><a class="text-white bg-principal"
                                    href="">{{$servidor->nombre}}</a>
                    </li>
                @else
                    <li><a href="{{ route('logs.show', $servidor->id) }}">{{$servidor->nombre}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="bg-white ml-64 rounded-2xl shadow p-10 w-9/12 mt-5 scrollable-div">
       <ul>
           @foreach($logs as $log)
              <li class="">
                  <strong> [{{ $log->tiempo }}]</strong>
                  <strong class="w-3 h-3 <?php if($log->tipo == "Admin"){echo 'text-red-700';}elseif($log->tipo == "Consola"){echo 'text-green-700';}elseif($log->tipo == "Jugador"){echo 'text-blue-700';}?>">
                      @if($log->nombre_jugador)
                          {{ $log->nombre_jugador }}:
                      @else
                          {{ $log->tipo }}:
                      @endif
                  </strong>
                  {{ $log->mensaje }}
              </li>
           @endforeach
       </ul>
    </div>
    <div class="p-5">
        {{ $logs->links() }}
    </div>

@endsection

@section("titulo")
    Alumno
@endsection
