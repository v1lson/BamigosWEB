@php use App\Models\Servidor; @endphp
@extends("layouts.layout")
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
  <div class="bg-white rounded-2xl w-4/12 float-left ml-32">
      <h2 class="text-white font-bold text-center text-2xl bg-principal p-2 rounded-t-2xl">Administradores</h2>
      <table class="w-full">
          @foreach($admins as $admin)
              <tr class="p-3 border-t-4 border-principal">
                  <td class="p-3 w-24"><a href="{{ route('profile.show', ['id' => $admin->id]) }}">
                          <img class="mask mask-circle w-16" src="{{ $admin->avatar }}" alt=""></a></td>
                  <td class="text-xl text-red-600 text-left"><a href="{{ route('profile.show', ['id' => $admin->id]) }}">
                      {{ $admin->name }}</a></td>
              </tr>
          @endforeach
      </table>
  </div>
  <div class="bg-white rounded-2xl w-4/12 float-right mr-32">
      <h2 class="text-white font-bold text-center text-2xl bg-principal p-2 rounded-t-2xl">Moderadores</h2>
      <table class="w-full">
          @foreach($moders as $moder)
              <tr class="p-3 border-t-4 border-principal">
                  <td class="p-3 w-24"><a href="{{ route('profile.show', ['id' => $moder->id]) }}">
                          <img class="mask mask-circle w-16" src="{{ $moder->avatar }}" alt=""></a></td>
                  <td class="text-xl text-blue-600 text-left"><a href="{{ route('profile.show', ['id' => $moder->id]) }}">
                          {{ $moder->name }}</a></td>
              </tr>
          @endforeach
      </table>
  </div>
@endsection

@section("titulo")
    Alumno
@endsection
