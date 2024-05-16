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
                    <td class="w-10">1.1</td>
                    <td>No se permite el uso de lenguaje ofensivo, discriminatorio o irrespetuoso en ninguna forma de comunicación dentro del entorno del juego.</td>
                </tr>
                <tr>
                    <td>1.2</td>
                    <td>Queda estrictamente prohibido el acoso, hostigamiento o discriminación hacia cualquier jugador o miembro del equipo de moderación, basado en características personales.</td>
                </tr>
                <tr>
                    <td>1.3</td>
                    <td>Se espera que todos los jugadores y moderadores mantengan un comportamiento respetuoso hacia los demás, evitando cualquier forma de confrontación o comportamiento disruptivo.</td>
                </tr>
                <tr>
                    <td>1.4</td>
                    <td>Los jugadores deben respetar las decisiones y directrices proporcionadas por los moderadores, siguiendo las instrucciones dadas en todo momento.</td>
                </tr>
                <tr>
                    <td>1.5</td>
                    <td>Se prohíbe la difusión de información falsa, engañosa o difamatoria en cualquier medio de comunicación relacionado con el juego.</td>
                </tr>
            </table>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="2. Jugadores"  />
        <div role="tabpanel" class="shadow tab-content bg-white rounded-box p-6">
            <table class="table table-zebra ">
                <tr>
                    <td class="w-10">2.1</td>
                    <td>Los jugadores deben jugar de manera justa y ética, evitando cualquier forma de trampa, manipulación o uso de exploits.</td>
                </tr>
                <tr>
                    <td>2.2</td>
                    <td>Se prohíbe la divulgación de información personal sensible, incluidas direcciones, números de teléfono o datos bancarios, en cualquier canal de comunicación del juego.</td>
                </tr>
                <tr>
                    <td>2.3</td>
                    <td>Los jugadores deben contribuir activamente a la comunidad del juego, participando en discusiones constructivas y brindando ayuda a otros jugadores cuando sea necesario.</td>
                </tr>
                <tr>
                    <td>2.4</td>
                    <td>Se espera que los jugadores mantengan una conducta amigable y cortés en todas las interacciones, promoviendo un ambiente de juego positivo y respetuoso.</td>
                </tr>
                <tr>
                    <td>2.5</td>
                    <td>Los jugadores deben cumplir con todas las reglas y directrices establecidas por el juego, aceptando las consecuencias de cualquier violación de las mismas.</td>
                </tr>
            </table>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="3. Moderadores" />
        <div role="tabpanel" class="shadow tab-content bg-white rounded-box p-6">
            <table class="table table-zebra ">
                <tr>
                    <td class="w-10">3.1</td>
                    <td>Los moderadores deben mantener la imparcialidad y la objetividad en todas las decisiones y acciones tomadas, evitando cualquier favoritismo o prejuicio.</td>
                </tr>
                <tr>
                    <td>3.2</td>
                    <td>Se espera que los moderadores comuniquen de manera clara y transparente todas las decisiones y acciones tomadas, proporcionando explicaciones detalladas cuando sea necesario.</td>
                </tr>
                <tr>
                    <td>3.3</td>
                    <td>Los moderadores deben aplicar las reglas y sanciones de manera justa y consistente, garantizando así la equidad y la integridad del juego.</td>
                </tr>
                <tr>
                    <td>3.4</td>
                    <td>Los moderadores deben actuar con profesionalismo y respeto en todas las interacciones con los jugadores, representando los valores y estándares de la comunidad de juego.</td>
                </tr>
                <tr>
                    <td>3.5</td>
                    <td>Los moderadores tienen la responsabilidad de resolver conflictos y disputas de manera efectiva y pacífica, promoviendo siempre un ambiente de juego armonioso.</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section("titulo")
    ⚖️Reglas | Bamigos
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
