@extends("layouts.layout")
@section("cabecera")
    <style>
        th, td{
            text-align: center;
        }
    </style>
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Bans</h2>
    <ul class="menu bg-white w-56 rounded-box float-left mt-5">
        @foreach($servidores as $servidor)
            @if(session('id_servidor') ==  $servidor->id)
                <li class=""><a class="text-white bg-principal" href="{{ route('Bans', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
            @else
                <li><a href="{{ route('Bans', ['id_servidor' => $servidor->id]) }}">{{$servidor->nombre}}</a></li>
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
                if ($fechaActual >= $ban->tiempo_final){
                    $ban->estado = 0;
                    $ban->save();
                }else{
                    $ban->estado = 1;
                    $ban->save();
                }
                $inicio->setTimestamp($ban->tiempo_inicio+7200);
                $final->setTimestamp($ban->tiempo_final+7200);
                ?>
            <tr>
                <td>{{$ban->id_servidor}}</td>
                <td>
                    <div style="margin: 0 auto" class="w-3 h-3 <?php if($ban->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                </td>
                <td>{{$ban->nombre}}</td>
                <td>{{$ban->razon}}</td>
                <td>{{$ban->nombre_moderador}}</td>
                <td>{{$inicio->format('d/m/Y H:i')}}</td>
                <td>{{$final->format('d/m/Y H:i')}}</td>
            </tr>
        @endforeach
    </table>
    <div class="h-20">
        {{ $bans->links() }}
    </div>
@endsection

@section("titulo")
    Alumno
@endsection
