@php use App\Http\SourceQuery\SourceQuery;use App\Models\Servidor;
$categorias = Servidor::distinct()->pluck('categoria')->toArray();;
@endphp
<div class=" mt-5 text-center w-2/3 h-64 mb-14 ">

    <ul class="menu menu-vertical lg:menu-horizontal bg-base-200 rounded-box">
        <li><a href="{{ route('/', ['categoria' => 'Todos']) }}">Todos</a></li>
        @foreach($categorias as $categoria)
            <li><a href="{{ route('/', ['categoria' => $categoria]) }}">{{$categoria}}</a></li>
        @endforeach
    </ul>
    <br>

    <div class="mt-5 h-full flex flex-wrap justify-evenly w-full">
        @foreach($servidores as $servidor)
                <?php
                $Query = new SourceQuery();
                $Info = [];
                try {
                    $Query->Connect($servidor->ip, $servidor->puerto);
                    $Info = $Query->GetInfo();
                    $mapa = $Info['Map'];
                } catch (Exception $e) {
                } finally {
                    $Query->Disconnect();
                }
                ?>
            @if(isset($Info["Players"]))
            <div class="card w-80 h-12 shadow-xl image-full">
                <figure><img class="w-full" src="{{asset("images/mapas/$mapa.jpg")}}"
                             alt="{{ $Info["Map"] }}"/></figure>
                <div class="card-body flex-nowrap flex-row content-center justify-around">
                    <div>
                        <p class="text-left"><?php echo $servidor->nombre ?></p>
                        <div class="flex items-center">
                            <progress class="progress progress-warning w-7" value="<?php echo $Info["Players"]?>"
                                      max="<?php echo $Info["MaxPlayers"]?>"></progress>
                            <p class="text-xs text-left"> <?php echo $Info["Map"] ?><br>
                                    <?php echo $Info["Players"] ?>/<?php echo $Info["MaxPlayers"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-actions flex-col ml-auto">
                        <a href="steam://connect/<?php echo $servidor->ip?>:<?php echo $servidor->puerto?>">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.6935 15.8458L15.4137 13.059C16.1954 12.5974 16.1954 11.4026 15.4137 10.941L10.6935 8.15419C9.93371 7.70561 9 8.28947 9 9.21316V14.7868C9 15.7105 9.93371 16.2944 10.6935 15.8458Z"
                                          fill="#ffffff"></path>
                                </g>
                            </svg>
                        </a>
                        <svg onclick="navigator.clipboard.writeText('connect {{ $servidor->ip }}:{{ $servidor->puerto }}').then(() => alert('Ip Copiada'))" width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M21 8C21 6.34315 19.6569 5 18 5H10C8.34315 5 7 6.34315 7 8V20C7 21.6569 8.34315 23 10 23H18C19.6569 23 21 21.6569 21 20V8ZM19 8C19 7.44772 18.5523 7 18 7H10C9.44772 7 9 7.44772 9 8V20C9 20.5523 9.44772 21 10 21H18C18.5523 21 19 20.5523 19 20V8Z" fill="#ffffff"></path> <path d="M6 3H16C16.5523 3 17 2.55228 17 2C17 1.44772 16.5523 1 16 1H6C4.34315 1 3 2.34315 3 4V18C3 18.5523 3.44772 19 4 19C4.55228 19 5 18.5523 5 18V4C5 3.44772 5.44772 3 6 3Z" fill="#ffffff"></path> </g></svg>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>

