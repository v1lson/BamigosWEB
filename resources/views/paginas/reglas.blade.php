@extends("layouts.layout")

@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Reglas</h2>
    <div role="tablist" class="tabs tabs-lifted mt-10">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="1. Generales"  checked/>
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 1</div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="2. Jugadores"  />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 2</div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="3. Moderadores" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">Tab content 3</div>
    </div>
@endsection
@section("titulo")
    proyecto laravel
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
