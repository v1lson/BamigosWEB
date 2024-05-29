@extends("layouts.layout")
@php
    use App\Models\User;
    use App\Models\RolUser;
    $auth= false;
    if (!auth()->guest()){
         if (strpos(RolUser::select('flags')->where('id',auth()->user()->rol)->value('flags'), 'r')){
              $auth = true;
         }
    }
    if (!$auth){
        echo "<script>window.location = '/';</script>";
        exit;
    }
@endphp
@section("cabecera")
    <style>
        th, td{
            text-align: center;
        }
        .input:focus,   .input:focus-within{
            outline: none;
            border: none;
        }
    </style>
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Servidores</h2>
    <a href="{{ route('Servidores.create') }}"><button class="mt-5 btn btn-ghost bg-principal text-white ml-2">Crear Servidor</button></a>
    <table class="table bg-white shadow table-zebra mt-5 mb-5 w-7/12 float-left">
        <tr>
            <th>Id</th>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Ip</th>
            <th>Puerto</th>
            <th>Rcon</th>
            <th>Acciones</th>
        </tr>
        @foreach($servidores as $servidor)
            <tr>
                <td>{{$servidor->id}}</td>
                <td>{{$servidor->categoria}}</td>
                <td>{{$servidor->nombre}}</td>
                <td>{{$servidor->ip}}</td>
                <td>{{$servidor->puerto}}</td>
                <td>{{$servidor->rcon}}</td>
                <td class="w-44">
                    <div class="flex justify-evenly">
                        <a class="hover:bg-gray-300 hover:rounded p-1" href="{{route("Servidores.show",$servidor)}}" title="Editar Servidor">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F"></path> </g></svg>
                        </a>
                        <div class="hover:bg-gray-300 hover:rounded p-1" onclick="my_modal_{{$servidor->id}}.showModal()" title="Borrar Servidor">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>
                        <dialog id="my_modal_{{$servidor->id}}" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">¿Borrar {{ $servidor->nombre }}?</h3>
                                <p class="py-4">¿Seguro que quieres borrar el servidor y todos los datos relacionados con el?</p>
                                <div class="modal-action">
                                    <form action="{{route("Servidores.destroy", $servidor->id)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn bg-red-600 text-white" type="submit">
                                            Borrar
                                        </button>
                                    </form>
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn">Close</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    @if(isset($crear))
        <div class="w-80 h-full float-right mt-5 ">
            <form action="{{route('Servidores.store') }}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
                <h3 class="font-bold text-xl">Crear Servidor</h3>
                @csrf
                @method('POST')
                <x-text-input class="mt-2" type="text" name="categoria" value="" placeholder="Categoria"/>
                <x-input-error class="" :messages="$errors->get('categoria')" /><br>

                <x-text-input class="" type="text" name="nombre" value="" placeholder="Nombre"/>
                <x-input-error class="mt-2" :messages="$errors->get('nombre')" /><br>

                <x-text-input class="" type="text" name="ip" value="" placeholder="Ip"/>
                <x-input-error class="mt-2" :messages="$errors->get('ip')"/><br>

                <x-text-input class="" type="text" name="puerto" value="" placeholder="Puerto"/>
                <x-input-error class="mt-2" :messages="$errors->get('puerto')"/><br>

                <x-text-input class="" type="text" name="rcon" value="" placeholder="Rcon"/>
                <x-input-error class="mt-2" :messages="$errors->get('rcon')"/><br>

                <x-text-input class="" type="hidden" name="created_by" value="{{ auth()->user()->id  }}"/>
                <x-primary-button class="mt-3">Crear</x-primary-button>
            </form>
        </div>
    @endif
    @if(isset($servidorMod))
        <div class="w-80 h-full float-right mt-5 ">
            <form action="{{route('Servidores.update', $servidorMod->id) }}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
                <h3 class="font-bold text-xl">Editar Servidor</h3>
                @csrf
                @method('PUT')
                <x-text-input class="" type="text" name="categoria" value="{{ $servidorMod->categoria }}" placeholder="Categoria"/>
                <x-input-error class="mt-2" :messages="$errors->get('categoria')" /><br>

                <x-text-input class="" type="text" name="nombre" value="{{ $servidorMod->nombre }}" placeholder="Nombre"/>
                <x-input-error class="mt-2" :messages="$errors->get('nombre')" /><br>

                <x-text-input class="" type="text" name="ip" value="{{ $servidorMod->ip }}" placeholder="Ip"/>
                <x-input-error class="mt-2" :messages="$errors->get('ip')"/><br>

                <x-text-input class="" type="text" name="puerto" value="{{ $servidorMod->puerto }}" placeholder="Puerto"/>
                <x-input-error class="mt-2" :messages="$errors->get('puerto')"/><br>

                <x-text-input class="" type="text" name="rcon" value="{{ $servidorMod->rcon }}" placeholder="Rcon"/>
                <x-input-error class="mt-2" :messages="$errors->get('rcon')"/><br>

                <x-text-input class="" type="hidden" name="created_by" value="{{ auth()->user()->id  }}"/>
                <x-primary-button class="mt-3">Actualizar</x-primary-button>
            </form>
        </div>
    @endif
@endsection

@section("titulo")
    Gestion Serviodres | Bamigos
@endsection
