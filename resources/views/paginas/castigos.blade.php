@php
    use App\Models\RolUser;use App\Models\Servidor;use App\Http\SourceQuery\SourceQuery;use App\Http\SourceQuery\SourceRcon;
    $auth = false;
     if (!auth()->guest()){
          if (strpos(RolUser::select('flags')->where('id',auth()->user()->rol)->value('flags'), 'b')){
               $auth = true;
          }
     }
     if (!$auth){
        echo "<script>window.location = '/';</script>";
        exit;
    }
    $servidores = Servidor::orderBy('categoria')->get();

	$Query = new SourceQuery( );
	$Players = [];
    $Info    = [];
	$Exception = null;

	try
	{
		$Query->Connect( $servidor->ip, $servidor->puerto, 3, SourceQuery::SOURCE );
        $Info    = $Query->GetInfo( );
		$Players = $Query->GetPlayers( );
	}
	catch( Exception $e ){
		$Exception = $e;
	}
	finally{
		$Query->Disconnect( );
	}
    $Query = new SourceQuery( );
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
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Admin panel</h2>
    @if(isset($msj))
            @php echo $msj; @endphp
    @endif

    <div class="float-left">
        @if(isset($nombre))
        <div class="w-80 h-full mt-5 ">
            @if(isset($ban))
            <form action="{{ route('Bans.store') }}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
            @elseif(isset($mute))
             <form action="{{ route('Mute.store') }}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
            @endif
                <h3 class="font-bold text-xl">Ban Menu</h3>
                @csrf
                @method('POST')
                <x-text-input class="mt-3" type="text" name="nombre" value="{{ $nombre }}" readonly/>

                <x-text-input id="razon" class="mt-3" type="text" name="razon" minlength="5" value="" placeholder="Razon"/>
                <x-input-error class="mt-2" :messages="$errors->get('razon')" /><br>
                <select name="periodo" id="periodo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-3 w-60">
                    <option value="1800">30 minutos</option>
                    <option value="3600">1 hora</option>
                    <option value="28800">8 horas</option>
                    <option value="86400">1 día</option>
                    <option value="604800">1 semana</option>
                </select>

                <x-text-input class="mt-3" type="text" name="steamId" value="{{ $steamId }}" readonly/>
                <x-text-input class="mt-3" type="hidden" name="moderador" value="{{ auth()->user()->name }}"/>
                <x-text-input class="mt-3" type="hidden" name="servidorId" value="{{ $servidor->id }}"/>
                @if($steamId != 'Error')
                   @if(isset($ban))
                        <x-primary-button class="mt-5">Banear</x-primary-button>
                    @elseif(isset($mute))
                        <x-primary-button class="mt-5">Mutear</x-primary-button>
                   @endif
                @else
                    <x-primary-button class="mt-5 bg-gray-400 hover:bg-gray-400 active:bg-gray-400" disabled>Usuario no encontrado</x-primary-button>
                @endif
            </form>
        </div>
        @endif
        <ul class="menu bg-white w-56 rounded-box mt-5">
            @foreach($servidores as $servidor)
                @if(session('id_servidor') ==  $servidor->id)
                    <li class=""><a class="text-white bg-principal"
                                    href="{{ route('Servidores.castigos', $servidor->id) }}">{{$servidor->nombre}}</a>
                    </li>
                @else
                    <li><a href="{{ route('Servidores.castigos', $servidor->id) }}">{{$servidor->nombre}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <table class="w-8/12 table bg-white shadow table-zebra mt-5 mb-5 ml-96">
        <tr>
            <th>Nombre</th>
            <th>Kills</th>
            <th>Tiempo Juega</th>
            <th>Acciones</th>
        </tr>
        @if($Players == [])
            <tr>
                <td colspan="7">No hay jugadores en el serviodr</td>
            </tr>
        @endif
        @foreach($Players as $Player)
            <tr>
                <td>{{ $Player['Name'] }}</td>
                <td>{{ $Player['Frags'] }}</td>
                <td>{{ $Player['TimeF'] }}</td>
                <td class="flex justify-center">
                    <form action="{{ route("Bans.create",session('id_servidor')) }}" method="POST">
                        @csrf
                        @method("POST")
                        <x-text-input type="hidden" name="nombre" value="{{ $Player['Name']  }}"/>
                        <input class="btn btn-ghost bg-principal text-white" type="submit" value="Ban">
                    </form>
                    <form action="{{ route("Mute.create",session('id_servidor')) }}"  method="POST">
                        @csrf
                        @method("POST")
                        <x-text-input type="hidden" name="nombre" value="{{ $Player['Name']  }}"/>
                        <input class="btn btn-ghost bg-red-600 text-white ml-3" type="submit" value="Mute">
                    </form>
                    <form action="{{ route("Bans.kick") }}" method="POST">
                        @csrf
                        @method("POST")
                        <x-text-input type="hidden" name="servidorId" value="{{ session('id_servidor')  }}"/>
                        <x-text-input type="hidden" name="nombre" value="{{ $Player['Name']  }}"/>
                        <x-primary-button class="btn btn-ghost bg-gray-700 text-white ml-3">Kick</x-primary-button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section("titulo")
    Admin Panel | Bamigos
@endsection
