@php
    use App\Models\RolUser;
    $auth = false;
     if (!auth()->guest()){
          if (strpos(RolUser::select('flags')->where('id',auth()->user()->rol)->value('flags'), 'b')){
               $auth = true;
          }
     }
@endphp
@extends("layouts.layout")
@section("cabecera")
    <style>
        th, td {
            text-align: center;
        }

        .input:focus, .input:focus-within {
            outline: none;
            border: none;
        }
    </style>
    @if($auth)
        <script>
            function seguro(nombre, id) {
                var url = document.getElementById('ban'+id).getAttribute('data-url');
                Swal.fire({
                    title: "¿Seguro?",
                    text: `Que quieres indultar el ban de ${nombre}`,
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
    <h2 class="text-center text-2xl text-principal font-bold">Bans</h2>
    <form class="mt-5 flex flex-row justify-end" action="{{route('Bans', ['id_servidor' => session('id_servidor')])}}"
          method="GET">
        <div class="form-control">
            <label class="label cursor-pointer mr-3">
                <span class="label-text mr-2">Solo Activos</span>
                <input name="estado" type="checkbox" class="checkbox" <?php if (isset($estado)) {
                    echo $estado ? 'checked="checked"' : '';
                } ?> />
            </label>
        </div>
        <input type="text" name="nombre" class="input mr-3" placeholder="Nombre"
               value="<?php if(isset($nombreBusqeuda)){echo $nombreBusqeuda ? : '';}?>"/>
        <input type="text" name="steamId" class="input" placeholder="Steam ID"
               value="<?php if(isset($steamId)){echo $steamId ? : '';}?>"/>
        <input class="btn bg-principal text-white ml-2" type="submit" value="Buscar">
    </form>
    <ul class="menu bg-white w-56 rounded-box float-left mt-5">
        @foreach($servidores as $servidor)
            @if(session('id_servidor') ==  $servidor->id)
                <li class=""><a class="text-white bg-principal"
                                href="{{ route('Bans', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a>
                </li>
            @else
                <li><a href="{{ route('Bans', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @endif
        @endforeach
    </ul>
   <div style=" overflow-x: auto;">
    <table class="w-11/12 table bg-white shadow table-zebra mt-5 mb-5 ml-10">
        <tr>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Razon</th>
            <th>Moderador</th>
            <th>Inicio</th>
            <th>Final</th>
            <th>Indultador</th>
        </tr>
        @if(count($bans)==0)
            <tr>
                <td colspan="7">Aun no hay Bans</td>
            </tr>
        @endif
        @foreach($bans as $ban)
                <?php
                $inicio = new DateTime();
                $final = new DateTime();
                $fechaActual = time();
                if ($fechaActual >= $ban->tiempo_final) {
                    $ban->estado = 0;
                    $ban->save();
                } else {
                    $ban->estado = 1;
                    $ban->save();
                }
                $inicio->setTimestamp($ban->tiempo_inicio + 7200);
                $final->setTimestamp($ban->tiempo_final + 7200);
                ?>
            <tr>
                <td>
                    <div
                         class="w-3 h-3 <?php if($ban->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                </td>
                <td>{{$ban->nombre}}</td>
                <td>{{$ban->razon}}</td>
                <td>{{$ban->nombre_moderador}}</td>
                <td>{{$inicio->format('d/m/Y H:i')}}</td>
                <td>{{$final->format('d/m/Y H:i')}}</td>
                <td>
                    @if($auth && $ban->estado)
                        <button id="ban{{ $ban->id }}" class="p-1 rounded btn-ghost bg-principal text-white" onclick="seguro('{{ $ban->nombre }}',{{ $ban->id }})"  data-url="{{ route('Bans.update',['id' => $ban->id,'user' => auth()->user()->name]) }}">
                            Indultar</button>
                    @elseif($ban->nombre_penalizador != null)
                        {{$ban->nombre_penalizador}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="p-5">
        {{ $bans->links() }}
    </div>
@endsection

@section("titulo")
    Bans | Bamigos
@endsection
