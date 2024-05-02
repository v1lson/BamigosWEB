@extends("layouts.layout")
@section("cabecera")
<style>
    .tab:focus-visible {
        outline: none;
    }
    input[type="radio"].tab:checked + label {
        background-color: #fff;
    }
</style>
@endsection
@section("contenido")
    <h2 class="text-center text-2xl text-principal font-bold">Reglas</h2>
    <div role="tablist" class="tabs tabs-lifted mt-10">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="1. Generales"  checked/>
        <div role="tabpanel" class="shadow tab-content bg-white rounded-box p-6">
            <table class="table table-zebra ">
                <tr>
                    <td>1.1</td>
                    <td>No se permite el lenguaje ofensivo.</td>
                </tr>
                <tr>
                    <td>1.2</td>
                    <td>No se permite el acoso o la discriminación.</td>
                </tr>
                <tr>
                    <td>1.3</td>
                    <td>Respeta a los demás jugadores y moderadores.</td>
                </tr>
            </table>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="2. Jugadores"  />
        <div role="tabpanel" class="shadow tab-content bg-white rounded-box p-6">
            <table class="table table-zebra ">
                <tr>
                    <td>2.1</td>
                    <td>No hagas trampas o exploits.</td>
                </tr>
                <tr>
                    <td>2.2</td>
                    <td>No compartas información personal.</td>
                </tr>
                <tr>
                    <td>2.3</td>
                    <td>Participa de forma activa y constructiva en la comunidad.</td>
                </tr>
            </table>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="3. Moderadores" />
        <div role="tabpanel" class="shadow tab-content bg-white rounded-box p-6">
            <table class="table table-zebra ">
                <tr>
                    <td>3.1</td>
                    <td>Mantén la imparcialidad y la objetividad al tomar decisiones.</td>
                </tr>
                <tr>
                    <td>3.2</td>
                    <td>Comunica claramente las decisiones y acciones tomadas.</td>
                </tr>
                <tr>
                    <td>3.3</td>
                    <td>Aplica las reglas de manera justa y consistente.</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section("titulo")
    proyecto laravel
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
