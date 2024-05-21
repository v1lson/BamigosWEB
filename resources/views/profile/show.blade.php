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
    <?php
    $mayor=0;
    $puntos=0;
    $disp=0;
    $rondasG=0;
    $kills=0;
    $muertes=0;
    $headshots=0;
    $tiempo=0;
    ?>
    <div class="bg-white shadow rounded-2xl p-6 flex w-4/12 float-left">
        <img class="mask mask-circle w-1/3" src="{{ $usuario->avatar }}" alt="Avatar de {{ $usuario->name }}" class="avatar">
        <div class="ml-5">
            <a target="_blank" href="https://steamcommunity.com/profiles/{{ $usuario->steam_id }}">
                <h2 class="text-2xl">{{ $usuario->name }}</h2>
            </a>
            <span>{{ $usuario->steamStat }}</span>
            <p class="<?php if($rol == 'Administrador'){echo 'text-red-700 font-bold';}if($rol == 'Moderador'){echo 'text-blue-700 font-bold';}?>">{{ $rol}}</p>
            @foreach($datos as $dato)
            <?php
                    $puntos+=$dato->value;
                    $disp+=$dato->shoots;
                    $rondasG+=$dato->round_win;
                    $kills+=$dato->kills;
                    $muertes+=$dato->deaths;
                    $headshots+=$dato->headshots;
                    $tiempo+=$dato->playtime;
                if ($dato->rank > $mayor){
                    $mayor = $dato->rank;
                }
            ?>
            @endforeach
            <img class="w-28 mt-3" src="{{asset("images/rangos/$mayor.png")}}" alt="">
        </div>
    </div>
    <div class="stats shadow ml-6 w-7/12">
        <div class="stat">
            <div class="stat-figure text-primary">
                <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M8.67 14H4C2.9 14 2 14.9 2 16V22H8.67V14Z" fill="#FF5E3A"></path> <path d="M13.3302 10H10.6602C9.56016 10 8.66016 10.9 8.66016 12V22H15.3302V12C15.3302 10.9 14.4402 10 13.3302 10Z" fill="#FF5E3A"></path> <path opacity="0.4" d="M20.0001 17H15.3301V22H22.0001V19C22.0001 17.9 21.1001 17 20.0001 17Z" fill="#FF5E3A"></path> <path d="M15.0097 4.84999C15.3197 4.53999 15.4397 4.16999 15.3397 3.84999C15.2397 3.52999 14.9297 3.3 14.4897 3.23L13.5297 3.06999C13.4897 3.05999 13.3997 2.99998 13.3797 2.95998L12.8497 1.89998C12.4497 1.08998 11.5397 1.08998 11.1397 1.89998L10.6097 2.95998C10.5897 2.99998 10.4997 3.05999 10.4597 3.06999L9.49968 3.23C9.05968 3.3 8.75969 3.52999 8.64969 3.84999C8.54969 4.16999 8.66968 4.53999 8.97968 4.84999L9.71969 5.59999C9.74969 5.62999 9.78968 5.75 9.77968 5.79L9.56968 6.70998C9.40968 7.38998 9.66968 7.69997 9.83968 7.82997C10.0097 7.94997 10.3797 8.10999 10.9897 7.74999L11.8897 7.21999C11.9297 7.18999 12.0597 7.18999 12.0997 7.21999L12.9997 7.74999C13.2797 7.91999 13.5097 7.96999 13.6897 7.96999C13.8997 7.96999 14.0497 7.88997 14.1397 7.82997C14.3097 7.70997 14.5697 7.39998 14.4097 6.70998L14.1997 5.79C14.1897 5.74 14.2197 5.62999 14.2597 5.59999L15.0097 4.84999Z" fill="#FF5E3A"></path> </g></svg>
            </div>
            <div class="stat-title">Total Puntos</div>
            <div class="stat-value text-principal">{{ $puntos }}</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">  .st0{fill:#FF5E3A;}  </style> <g> <path class="st0" d="M495.212,16.785c-44.125-44.141-188.297,5.875-250.078,67.656S61.79,267.8,61.79,267.8l182.406,182.407 c0,0,121.563-121.579,183.359-183.36C489.321,205.082,539.337,60.91,495.212,16.785z"></path> <polygon class="st0" points="0.009,329.597 182.399,512.004 217.712,476.691 35.306,294.285 "></polygon> </g> </g></svg>
            </div>
            <div class="stat-title">Total Disparos</div>
            <div class="stat-value text-principal">{{ $disp }}</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 32 32" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .puchipuchi_een{fill:#FF5E3A;} </style> <path class="puchipuchi_een" d="M23,30c0,0.552-0.448,1-1,1H10c-0.552,0-1-0.448-1-1s0.448-1,1-1h12C22.552,29,23,29.448,23,30z M31,4v4c0,3.204-2.033,5.525-5.047,5.93c-0.408,4.417-3.685,8.002-7.953,8.869V25h2c0.55,0,1,0.45,1,1v2H11v-2c0-0.55,0.45-1,1-1h2 v-2.201c-4.268-0.866-7.545-4.452-7.953-8.869C3.033,13.525,1,11.204,1,8V4c0-2.201,1.794-3,3-3h24C29.206,1,31,1.799,31,4z M6,3H4 C3.55,3.012,3,3.195,3,4v4c0,2.075,1.152,3.514,3,3.892V3z M17,20c0-0.552-0.448-1-1-1c-3.309,0-6-2.691-6-6c0-0.552-0.448-1-1-1 s-1,0.448-1,1c0,4.411,3.589,8,8,8C16.552,21,17,20.552,17,20z M29,4c0-0.805-0.55-0.988-1.012-1H26v8.892 c1.848-0.378,3-1.817,3-3.892V4z"></path> </g></svg>
            </div>
            <div class="stat-title">Rondas Ganadas</div>
            <div class="stat-value text-principal">{{ $rondasG }}</div>
        </div>
    </div>
    <div class="stats shadow mt-6 ml-6 w-7/12">
        <div class="stat">
            <div class="stat-figure text-primary">
                <svg fill="#FF5E3A" width="64px" height="64px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M20,4H4A2,2,0,0,0,2,6V18a2,2,0,0,0,2,2H20a2,2,0,0,0,2-2V6A2,2,0,0,0,20,4ZM9,16a1,1,0,0,1-2,0V12a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V10a1,1,0,0,1,2,0Zm4,0a1,1,0,0,1-2,0V8a1,1,0,0,1,2,0Z"></path></g></svg>
            </div>
            <div class="stat-title">Asesinatos/Muertes</div>
            <div class="stat-value text-principal">

                <?php
                    if ($muertes > 0){
                        echo number_format($kills/$muertes, 2);
                    }else{
                        echo $kills;
                    }
                ?>
            </div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg width="64px" height="64px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="" stroke=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#FF5E3A" d="M364.656 17.125l7.22 27-58.188 14.625c3.298 5.667 6.192 11.376 8.625 17.094l54.406-13.688 7.56 28.313 78.533-60.376-98.157-12.97zm-130.5 7.22c-.89-.005-1.776-.002-2.656.03-5.235.19-10.23 1.107-14.594 2.906.073.114-1.306 1.3-4.47 3.126-13.95 8.048-22.286 23.685-23.5 42.032l30.814-8.25c5.387-1.447 10.49-2.095 15.25-1.97 4.76.127 9.176 1.01 13.125 2.626 7.897 3.23 13.85 9.614 15.938 17.28 2.086 7.668.163 16.203-5.063 22.97-5.226 6.767-13.5 11.933-24.344 14.844l-28.687 7.687c9.082 12.388 20.716 21.374 32.78 26.75L255.875 162l-16.406 9.094c-13.034 7.208-20.893 17.79-25.72 31.844-4.827 14.052-6.2 31.546-5.063 50.687 2.098 35.29 12.573 75.595 22 110.78l33.22-9 11-3 .75 11.408 8.5 128.812h100.78l9.157-165.53.375-6.75 6.56-1.75 36.376-9.69c-9.556-37.034-19.253-81.292-35.75-114.936-8.91-18.17-19.682-32.927-32.72-42-13.035-9.076-28.278-13.115-49.03-9.44l-16.125 2.876 5.75-15.344c6.438-17.216 1.314-40.236-13.717-64.843-15.132-24.773-38.14-39.68-58.97-40.814-.9-.05-1.796-.06-2.687-.062zm.313 56.56c-2.74-.07-6.023.28-9.876 1.314l-103.78 27.874-33.19-18.813-71.874 19.25 46.5 26.845-26.844 46.5 71.313-19.125 20.374-35.28 102.72-27.595c7.8-2.094 12.25-5.398 14.405-8.188 2.153-2.79 2.286-4.91 1.81-6.656-.474-1.745-1.714-3.53-5-4.874-1.64-.672-3.822-1.18-6.56-1.25z"></path></g></svg>
            </div>
            <div class="stat-title">Total Headshots</div>
            <div class="stat-value text-principal">{{ $headshots }}</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg width="64px" height="64px" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg" fill="" stroke=""><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#FF5E3A" fill-rule="evenodd" d="M207.960546,159.843246 L210.399107,161.251151 C210.637153,161.388586 210.71416,161.70086 210.580127,161.933013 C210.442056,162.172159 210.144067,162.258604 209.899107,162.117176 L207.419233,160.68542 C207.165323,160.8826 206.846372,161 206.5,161 C205.671573,161 205,160.328427 205,159.5 C205,158.846891 205.417404,158.291271 206,158.085353 L206,153.503423 C206,153.22539 206.231934,153 206.5,153 C206.776142,153 207,153.232903 207,153.503423 L207,158.085353 C207.582596,158.291271 208,158.846891 208,159.5 C208,159.6181 207.986351,159.733013 207.960546,159.843246 Z M206.5,169 C211.746705,169 216,164.746705 216,159.5 C216,154.253295 211.746705,150 206.5,150 C201.253295,150 197,154.253295 197,159.5 C197,164.746705 201.253295,169 206.5,169 Z" transform="translate(-197 -150)"></path> </g></svg>
            </div>
            <div class="stat-title">Tiempo Jugado</div>
            <div class="stat-value text-principal">
                <?php
                      if ($tiempo>86400){
                          echo number_format($tiempo/86400, 2)." Dias";
                      }elseif ($tiempo>3600){
                          echo number_format($tiempo/3600, 1)." Horas";
                      }else{
                          echo number_format($tiempo/60, 2)." Min";
                      }
                ?>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto mt-5 mr-6">
        <h3 class="py-1 bg-white w-24 mb-5 text-center mb-2 shadow-[3px_3px_0px_rgba(255,94,58,1)]">Bans</h3>
        <table class="table bg-white shadow table-zebra">
            <tr>
                <th>Servidor</th>
                <th>Estado</th>
                <th>Razon</th>
                <th>Nombre Moderador</th>
                <th>Inicio</th>
                <th>Final</th>
            </tr>
            @if(count($bans)==0)
                <tr>
                    <td class="text-center" colspan="7">Este jugador no tiene Bans</td>
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
                    <td>{{Servidor::where('id',$ban->id_servidor)->value('nombre')}}</td>
                    <td>
                        <div style="margin: 0 auto" class="w-3 h-3 <?php if($ban->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                    </td>
                    <td>{{$ban->razon}}</td>
                    <td>{{$ban->nombre_moderador}}</td>
                    <td>{{$inicio->format('d/m/Y H:i')}}</td>
                    <td>{{$final->format('d/m/Y H:i')}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="overflow-x-auto mt-5 mr-6">
        <h3 class="py-1 bg-white w-24 mb-5 text-center mb-2 shadow-[3px_3px_0px_rgba(255,94,58,1)]">Mutes</h3>
        <table class="table bg-white shadow table-zebra">
            <tr>
                <th>Servidor</th>
                <th>Estado</th>
                <th>Razon</th>
                <th>Nombre Moderador</th>
                <th>Inicio</th>
                <th>Final</th>
            </tr>
            @if(count($mutes)==0)
                <tr>
                    <td class="text-center" colspan="7">Este jugador no tiene Mutes</td>
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
                    $inicio->setTimestamp($mute->tiempo_inicio+7200);
                    $final->setTimestamp($mute->tiempo_final+7200);
                    ?>
                <tr>
                    <td>{{Servidor::where('id',$mute->id_servidor)->value('nombre')}}</td>
                    <td>
                        <div style="margin: 0 auto" class="w-3 h-3 <?php if($mute->estado){echo 'bg-red-700';}else{echo 'bg-green-700';}?> rounded-full"></div>
                    </td>
                    <td>{{$mute->razon}}</td>
                    <td>{{$mute->nombre_moderador}}</td>
                    <td>{{$inicio->format('d/m/Y H:i')}}</td>
                    <td>{{$final->format('d/m/Y H:i')}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@section("titulo")
    {{ $usuario->name }} | Bamigos
@endsection
