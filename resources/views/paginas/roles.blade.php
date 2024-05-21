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
    <h2 class="text-center text-2xl text-principal font-bold">Roles</h2>
    <a href="{{ route('Roles.create') }}"><button class="mt-5 btn btn-ghost bg-principal text-white ml-2">Crear Rol</button></a>
    <table class="table bg-white shadow table-zebra mt-5 mb-5 w-8/12 float-left">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Flags</th>
            <th>Total Usuarios</th>
            <th>Acciones</th>
        </tr>
        @foreach($roles as $rol)
            <tr>
                <td>{{$rol->id}}</td>
                <td>{{$rol->nombre}}</td>
                <td>{{$rol->flags}}</td>
                <td>{{ User::where('rol', $rol->id)->count() }}</td>
                <td class="w-44">
                    <div class="flex justify-evenly">
                        <a class="hover:bg-gray-300 hover:rounded p-1" href="{{route("Roles.show",$rol->id)}}" title="Editar Rol">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#0F0F0F"></path> </g></svg>
                        </a>
                        <a class="hover:bg-gray-300 hover:rounded p-1" href="{{ route('Roles.showAddUser', $rol) }}" title="Añadir Usuario">
                            <svg width="24px" height="24px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="add-user-left-7" transform="translate(-2 -2)"> <path id="secondary" fill="#FF5E3A" d="M17.29,13.19a6,6,0,0,1-8.58,0A5,5,0,0,0,5,18v1s2,2,8,2,8-2,8-2V18a5,5,0,0,0-3.71-4.81Z"></path> <path id="primary" d="M7,5H3M5,3V7" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <path id="primary-2" data-name="primary" d="M7.35,11A6,6,0,1,0,13,3a5.8,5.8,0,0,0-2,.35" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> <path id="primary-3" data-name="primary" d="M17.29,13.19A5,5,0,0,1,21,18v1s-2,2-8,2-8-2-8-2V18a5,5,0,0,1,3.71-4.81" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </g> </g></svg>                        </a>
                        <a class="hover:bg-gray-300 hover:rounded p-1" href="{{ route('Roles.showAllUsers', $rol)  }}" title="Listado Usuarios">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 20V18C13 15.2386 10.7614 13 8 13C5.23858 13 3 15.2386 3 18V20H13ZM13 20H21V19C21 16.0545 18.7614 14 16 14C14.5867 14 13.3103 14.6255 12.4009 15.6311M11 7C11 8.65685 9.65685 10 8 10C6.34315 10 5 8.65685 5 7C5 5.34315 6.34315 4 8 4C9.65685 4 11 5.34315 11 7ZM18 9C18 10.1046 17.1046 11 16 11C14.8954 11 14 10.1046 14 9C14 7.89543 14.8954 7 16 7C17.1046 7 18 7.89543 18 9Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </a>
                        <div class="hover:bg-gray-300 hover:rounded p-1" onclick="my_modal_{{$rol->id}}.showModal()" title="Borrar Servidor">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>
                        <dialog id="my_modal_{{$rol->id}}" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">¿Borrar {{ $rol->nombre }}?</h3>
                                <p class="py-4">¿Seguro que quieres borrar el rol y todos los datos relacionados con el?</p>
                                <div class="modal-action">
                                    <form action="{{route("Roles.destroy", $rol->id)}}" method="POST">
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
            <form action="{{route('Roles.store') }}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
                <h3 class="font-bold text-xl">Crear Rol</h3>
                @csrf
                @method('POST')
                <x-text-input class="mt-3" type="text" name="nombre" value="" placeholder="Nombre"/>
                <x-input-error class="mt-2" :messages="$errors->get('nombre')" /><br>

                <x-text-input class="mt-3" type="text" name="flags" value="" placeholder="Flags"/>
                <x-input-error class="mt-2" :messages="$errors->get('flags')"/><br>

                <x-primary-button class="mt-5">Crear</x-primary-button>
            </form>
            <div class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 text-center">
                <h3 class="font-bold text-xl">Flags</h3>
                <ul class="mt-3 text-left ml-10">
                    <li><strong>q</strong> - del usuario normal</li>
                    <li><strong>r</strong> - modificar y asignar los roles</li>
                    <li><strong>s</strong> - crear y editar los serviodres</li>
                    <li><strong>b</strong> - indultar los bans y acceso a admin panel</li>
                    <li><strong>m</strong> - indultar los mutes</li>
                    <li><strong>l</strong> - acceso a los logs</li>
                </ul>
            </div>
        </div>
    @endif
    @if(isset($users))
        <div class="w-80 h-full  float-right mt-5 rounded-2xl bg-white shadow-md ">
            <h3 class="text-center mt-5 font-bold text-xl">Usuarios con Rol</h3>
           <ul class="pt-6 pb-8 mb-4 ml-20">
               @foreach($users as $user)
                    <li class="hover:font-bold"><a href="/profile/{{ $user->id }}">{{ $user->id }} || {{ $user->name }}</a></li>
               @endforeach
           </ul>
        </div>
    @endif
    @if(isset($rolAddUser))
        <div class="w-80 h-full float-right mt-5 ">
            <form action="{{route('profile.update')}}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
                <h3 class="font-bold text-xl">Cambiar Rol</h3>
                @csrf
                @method('POST')
                <x-text-input class="mt-3" type="text" name="idUser" value="" placeholder="Id del usuario"/>
                <x-input-error class="mt-2" :messages="$errors->get('idUser')" /><br>

                <x-text-input class="mt-3" type="text" name="nameRol" value="{{$rolAddUser->nombre}}" disabled/>
                <x-text-input class="mt-3" type="hidden" name="rol" value="{{$rolAddUser->id}}"/>

                <x-primary-button class="mt-5">Actualizar</x-primary-button>
            </form>
        </div>
    @endif
    @if(isset($rolMod))
        <div class="w-80 h-full float-right mt-5 ">
            <form action="{{route('Roles.update', $rolMod[0]->id)}}" method="POST" class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 flex flex-col items-center justify-center">
                <h3 class="font-bold text-xl">Editar Rol</h3>
                @csrf
                @method('PUT')
                <x-text-input class="mt-3" type="text" name="nombre"
                              value="{{$rolMod[0]->nombre}}" placeholder="Nombre"/>
                <x-input-error class="mt-2" :messages="$errors->get('nombre')" /><br>

                <x-text-input class="mt-3" type="text" name="flags" value="{{$rolMod[0]->flags}}" placeholder="Flags"/>
                <x-input-error class="mt-2" :messages="$errors->get('flags')"/><br>

                <x-primary-button class="mt-5">Actualizar</x-primary-button>
            </form>
            <div class="rounded-2xl bg-white shadow-md pt-6 pb-8 mb-4 text-center">
                <h3 class="font-bold text-xl">Flags</h3>
                <ul class="mt-3 text-left ml-10">
                    <li><strong>q</strong> - del usuario normal</li>
                    <li><strong>r</strong> - modificar y asignar los roles</li>
                    <li><strong>s</strong> - crear y editar los serviodres</li>
                    <li><strong>b</strong> - indultar los bans y acceso a admin panel</li>
                    <li><strong>m</strong> - indultar los mutes</li>
                    <li><strong>l</strong> - acceso a los logs</li>
                </ul>
            </div>
        </div>
    @endif
@endsection

@section("titulo")
    Roles | Bamigos
@endsection
