@extends("layouts.layout")
@section("cabecera")
    <style>
        th, td{
            text-align: center;
        }
    </style>
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Mutes</h2>
    <ul class="menu bg-white w-56 rounded-box float-left mt-5">
        @foreach($servidores as $servidor)
            @if(session('id_servidor') ==  $servidor->id)
                <li class=""><a class="text-white bg-principal" href="{{ route('Mute', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @else
                <li><a href="{{ route('Mute', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @endif
        @endforeach
    </ul>
    <table class="w-10/12 table bg-white table shadow table-zebra mt-5 mb-5 ml-64">
        <tr>
            <th>Id Servidor</th>
            <th>Estado</th>
            <th>Nombre</th>
            <th>Razon</th>
            <th>Moderador</th>
            <th>Inicio</th>
            <th>Final</th>
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
                <td>{{$mute->id_servidor}}</td>
                <td>
                    <div style="margin: 0 auto"  class="w-3 h-3 <?php if($mute->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                </td>
                <td>{{$mute->nombre}}</td>
                <td>{{$mute->razon}}</td>
                <td>{{$mute->nombre_moderador}}</td>
                <td>{{$inicio->format('d/m/Y H:i')}}</td>
                <td>{{$final->format('d/m/Y H:i')}}</td>
            </tr>
        @endforeach
    </table>
    <div class="h-20">
        {{ $mutes->links() }}
    </div>
@endsection

@section("titulo")
    Alumno
@endsection
