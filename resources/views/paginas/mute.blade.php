@php
    use App\Models\RolUser;
    $auth = false;
     if (!auth()->guest()){
          if (strpos(RolUser::select('flags')->where('id',auth()->user()->rol)->value('flags'), 'm')){
               $auth = true;
          }
     }
@endphp
@extends("layouts.layout")
@section("cabecera")
    <style>
        th, td{
            text-align: center;
        }
    </style>
    @if($auth)
        <script>
            function seguro(nombre, id) {
                var url = document.getElementById('mute'+id).getAttribute('data-url');
                Swal.fire({
                    title: "¿Seguro?",
                    text: `Que quieres indultar el mute de ${nombre}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, indultar!",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }

        </script>
    @endif
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Mutes</h2>
    <form class="mt-5 flex flex-row justify-end" action="{{route('Mute', ['id_servidor' => session('id_servidor')])}}" method="GET">
        <div class="form-control">
            <label class="label cursor-pointer mr-3">
                <span class="label-text mr-2">Solo Activos</span>
                <input name="estado" type="checkbox" class="checkbox" <?php if(isset($estado)){echo $estado ? 'checked="checked"'  : '';}?> />
            </label>
        </div>
        <input type="text" name="nombre" class="input mr-3" placeholder="Nombre" value="<?php if(isset($nombreBusqeuda)){echo $nombreBusqeuda ? : '';}?>"/>
        <input type="text" name="steamId" class="input" placeholder="Steam ID" value="<?php if(isset($steamId)){echo $steamId ? : '';}?>"/>
        <input class="btn bg-principal text-white ml-2" type="submit" value="Buscar">
    </form>
    <ul class="menu bg-white w-56 rounded-box float-left mt-5">
        @foreach($servidores as $servidor)
            @if(session('id_servidor') ==  $servidor->id)
                <li class=""><a class="text-white bg-principal" href="{{ route('Mute', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @else
                <li><a href="{{ route('Mute', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @endif
        @endforeach
    </ul>
    <table class="w-9/12 table bg-white table shadow table-zebra mt-5 mb-5 ml-64">
        <tr>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Razon</th>
            <th>Moderador</th>
            <th>Inicio</th>
            <th>Final</th>
            <th>Indultador</th>
        </tr>
        @if(count($mutes)==0)
            <tr>
                <td colspan="7">Aun no hay Mutes</td>
            </tr>
        @endif
        @foreach($mutes as $mute)
                <?php
                $inicio = new DateTime();
                $final = new DateTime();
                $fechaActual = time();
                if ($fechaActual >= $mute->tiempo_final){
                    $mute->estado = 0;
                    $mute->save();
                }else{
                    $mute->estado = 1;
                    $mute->save();
                }
                $inicio->setTimestamp($mute->tiempo_inicio);
                $final->setTimestamp($mute->tiempo_final);

                ?>
            <tr>
                <td>
                    <div style="margin: 0 auto"  class="w-3 h-3 <?php if($mute->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                </td>
                <td>{{$mute->nombre}}</td>
                <td>{{$mute->razon}}</td>
                <td>{{$mute->nombre_moderador}}</td>
                <td>{{$inicio->format('d/m/Y H:i')}}</td>
                <td>{{$final->format('d/m/Y H:i')}}</td>
                <td>
                    @if($auth && $mute->estado)
                        <button id="mute{{ $mute->id }}" class="p-1 rounded btn-ghost bg-principal text-white" onclick="seguro('{{ $mute->nombre }}',{{ $mute->id }})"  data-url="{{ route('Mute.update',['id' => $mute->id,'user' => auth()->user()->name]) }}">
                            Indultar</button>
                    @elseif($mute->nombre_penalizador != null)
                        {{$mute->nombre_penalizador}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div class="h-20">
        {{ $mutes->links() }}
    </div>
@endsection

@section("titulo")
    Mutes | Bamigos
@endsection
