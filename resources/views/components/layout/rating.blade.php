@php use App\Models\Estadistica;use App\Models\User; @endphp
@foreach($servidores as $servidor)
        <?php
        $estadisticas = Estadistica::select("steam", "name", "value")->where("id_server", $servidor->id)->orderBy('value', 'desc')->get();
        $estadisticas = json_decode($estadisticas, true);
        $steamids = [];
        $usuarios = [];
        foreach ($estadisticas as $estadistica){
            $partes = explode(":", $estadistica['steam']);
            $parteNum = $partes[2];
            $steamId64 = ($parteNum * 2) + 76561197960265728 + $partes[1];
            $steamids[] = $steamId64;
            $usuario = User::select('id','avatar')->where('steam_id', 'LIKE', "{$steamId64}")->first();
            if ($usuario) {
                $usuarios['a'.$steamId64] = $usuario->toArray();
            }
        }
        ?>
    @if(count(collect($estadisticas)) > 0)
    <div class="h-full mb-5">
        <h2 class="py-1 bg-white w-1/2 text-center mb-2 shadow-[3px_3px_0px_rgba(255,94,58,1)]">{{$servidor->nombre}}</h2>
        <div class="bg-white w-80 h-44 flex items-end rounded-xl justify-stretch shadow">
            @if(count(collect($estadisticas)) > 1)
            <div class="flex flex-col items-center pb-3 w-1/3">
                <svg class="-mb-3 z-10" width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M19.6872 14.0931L19.8706 12.3884C19.9684 11.4789 20.033 10.8783 19.9823 10.4999L20 10.5C20.8284 10.5 21.5 9.82843 21.5 9C21.5 8.17157 20.8284 7.5 20 7.5C19.1716 7.5 18.5 8.17157 18.5 9C18.5 9.37466 18.6374 9.71724 18.8645 9.98013C18.5384 10.1814 18.1122 10.606 17.4705 11.2451L17.4705 11.2451C16.9762 11.7375 16.729 11.9837 16.4533 12.0219C16.3005 12.043 16.1449 12.0213 16.0038 11.9592C15.7492 11.847 15.5794 11.5427 15.2399 10.934L13.4505 7.7254C13.241 7.34987 13.0657 7.03557 12.9077 6.78265C13.556 6.45187 14 5.77778 14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 5.77778 10.444 6.45187 11.0923 6.78265C10.9343 7.03559 10.759 7.34984 10.5495 7.7254L8.76006 10.934C8.42056 11.5427 8.25081 11.847 7.99621 11.9592C7.85514 12.0213 7.69947 12.043 7.5467 12.0219C7.27097 11.9837 7.02381 11.7375 6.5295 11.2451C5.88787 10.606 5.46156 10.1814 5.13553 9.98012C5.36264 9.71724 5.5 9.37466 5.5 9C5.5 8.17157 4.82843 7.5 4 7.5C3.17157 7.5 2.5 8.17157 2.5 9C2.5 9.82843 3.17157 10.5 4 10.5L4.01771 10.4999C3.96702 10.8783 4.03162 11.4789 4.12945 12.3884L4.3128 14.0931C4.41458 15.0393 4.49921 15.9396 4.60287 16.75H19.3971C19.5008 15.9396 19.5854 15.0393 19.6872 14.0931Z" fill="#9E9E9E"></path>
                        <path d="M10.9121 21H13.0879C15.9239 21 17.3418 21 18.2879 20.1532C18.7009 19.7835 18.9623 19.1172 19.151 18.25H4.84896C5.03765 19.1172 5.29913 19.7835 5.71208 20.1532C6.65817 21 8.07613 21 10.9121 21Z" fill="#9E9E9E"></path>
                    </g>
                </svg>
                @if (isset($usuarios['a'.$steamids[1]]['id']))
                    <a class="flex flex-col items-center" target="_blank" href="{{ route('profile.show', ['id' => $usuarios['a'.$steamids[1]]['id']]) }}">
                        <img class="mask mask-circle w-16" src="{{ $usuarios['a'.$steamids[1]]['avatar']}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[1]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[1]['value'] }}</span>
                    </a>
                @else
                    <a class="flex flex-col items-center" target="_blank" href="https://steamcommunity.com/profiles/{{ $steamids[1] }}">
                        <img class="mask mask-circle w-16" src="{{asset("images/avatars.png")}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[1]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[1]['value'] }}</span>
                    </a>
                @endif
            </div>
            @endif
            <div class="flex flex-col items-center pb-3 w-1/3">
                <svg class="-mb-4 z-10" width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M19.6872 14.0931L19.8706 12.3884C19.9684 11.4789 20.033 10.8783 19.9823 10.4999L20 10.5C20.8284 10.5 21.5 9.82843 21.5 9C21.5 8.17157 20.8284 7.5 20 7.5C19.1716 7.5 18.5 8.17157 18.5 9C18.5 9.37466 18.6374 9.71724 18.8645 9.98013C18.5384 10.1814 18.1122 10.606 17.4705 11.2451L17.4705 11.2451C16.9762 11.7375 16.729 11.9837 16.4533 12.0219C16.3005 12.043 16.1449 12.0213 16.0038 11.9592C15.7492 11.847 15.5794 11.5427 15.2399 10.934L13.4505 7.7254C13.241 7.34987 13.0657 7.03557 12.9077 6.78265C13.556 6.45187 14 5.77778 14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 5.77778 10.444 6.45187 11.0923 6.78265C10.9343 7.03559 10.759 7.34984 10.5495 7.7254L8.76006 10.934C8.42056 11.5427 8.25081 11.847 7.99621 11.9592C7.85514 12.0213 7.69947 12.043 7.5467 12.0219C7.27097 11.9837 7.02381 11.7375 6.5295 11.2451C5.88787 10.606 5.46156 10.1814 5.13553 9.98012C5.36264 9.71724 5.5 9.37466 5.5 9C5.5 8.17157 4.82843 7.5 4 7.5C3.17157 7.5 2.5 8.17157 2.5 9C2.5 9.82843 3.17157 10.5 4 10.5L4.01771 10.4999C3.96702 10.8783 4.03162 11.4789 4.12945 12.3884L4.3128 14.0931C4.41458 15.0393 4.49921 15.9396 4.60287 16.75H19.3971C19.5008 15.9396 19.5854 15.0393 19.6872 14.0931Z" fill="#FFC107"></path>
                        <path d="M10.9121 21H13.0879C15.9239 21 17.3418 21 18.2879 20.1532C18.7009 19.7835 18.9623 19.1172 19.151 18.25H4.84896C5.03765 19.1172 5.29913 19.7835 5.71208 20.1532C6.65817 21 8.07613 21 10.9121 21Z" fill="#FFC107"></path>
                    </g>
                </svg>
                @if (isset($usuarios['a'.$steamids[0]]['id']))
                    <a class="flex flex-col items-center" target="_blank" href="{{ route('profile.show', ['id' => $usuarios['a'.$steamids[0]]['id']]) }}">
                        <img class="mask mask-circle w-20" src="{{ $usuarios['a'.$steamids[0]]['avatar']}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[0]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[0]['value'] }}</span>
                    </a>
                @else
                    <a class="flex flex-col items-center" target="_blank" href="https://steamcommunity.com/profiles/{{ $steamids[0] }}">
                        <img class="mask mask-circle w-20" src="{{asset("images/avatars.png")}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[0]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[0]['value'] }}</span>
                    </a>
                @endif
            </div>
            @if(count(collect($estadisticas)) > 2)
            <div class="flex flex-col items-center pb-3 w-1/3">
                <svg class="-mb-2 z-10" width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M19.6872 14.0931L19.8706 12.3884C19.9684 11.4789 20.033 10.8783 19.9823 10.4999L20 10.5C20.8284 10.5 21.5 9.82843 21.5 9C21.5 8.17157 20.8284 7.5 20 7.5C19.1716 7.5 18.5 8.17157 18.5 9C18.5 9.37466 18.6374 9.71724 18.8645 9.98013C18.5384 10.1814 18.1122 10.606 17.4705 11.2451L17.4705 11.2451C16.9762 11.7375 16.729 11.9837 16.4533 12.0219C16.3005 12.043 16.1449 12.0213 16.0038 11.9592C15.7492 11.847 15.5794 11.5427 15.2399 10.934L13.4505 7.7254C13.241 7.34987 13.0657 7.03557 12.9077 6.78265C13.556 6.45187 14 5.77778 14 5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5C10 5.77778 10.444 6.45187 11.0923 6.78265C10.9343 7.03559 10.759 7.34984 10.5495 7.7254L8.76006 10.934C8.42056 11.5427 8.25081 11.847 7.99621 11.9592C7.85514 12.0213 7.69947 12.043 7.5467 12.0219C7.27097 11.9837 7.02381 11.7375 6.5295 11.2451C5.88787 10.606 5.46156 10.1814 5.13553 9.98012C5.36264 9.71724 5.5 9.37466 5.5 9C5.5 8.17157 4.82843 7.5 4 7.5C3.17157 7.5 2.5 8.17157 2.5 9C2.5 9.82843 3.17157 10.5 4 10.5L4.01771 10.4999C3.96702 10.8783 4.03162 11.4789 4.12945 12.3884L4.3128 14.0931C4.41458 15.0393 4.49921 15.9396 4.60287 16.75H19.3971C19.5008 15.9396 19.5854 15.0393 19.6872 14.0931Z" fill="#7F4A00"></path>
                        <path d="M10.9121 21H13.0879C15.9239 21 17.3418 21 18.2879 20.1532C18.7009 19.7835 18.9623 19.1172 19.151 18.25H4.84896C5.03765 19.1172 5.29913 19.7835 5.71208 20.1532C6.65817 21 8.07613 21 10.9121 21Z" fill="#7F4A00"></path>
                    </g>
                </svg>
                @if (isset($usuarios['a'.$steamids[2]]['id']))
                    <a class="flex flex-col items-center" target="_blank" href="{{ route('profile.show', ['id' => $usuarios['a'.$steamids[2]]['id']]) }}">
                        <img class="mask mask-circle w-14" src="{{ $usuarios['a'.$steamids[2]]['avatar']}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[2]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[2]['value'] }}</span>
                    </a>
                @else
                    <a class="flex flex-col items-center" target="_blank" href="https://steamcommunity.com/profiles/{{ $steamids[2] }}">
                        <img class="mask mask-circle w-14" src="{{asset("images/avatars.png")}}"/>
                        <span class="text-xs font-bold"> {{ $estadisticas[2]['name'] }}</span>
                        <span class="text-xs">{{ $estadisticas[2]['value'] }}</span>
                    </a>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endif
@endforeach
