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
                } catch (Exception $e) {
                } finally {
                    $Query->Disconnect();
                }
                ?>
            <div class="card w-80 h-12 shadow-xl image-full">
                <figure><img class="w-full" src="{{asset("images/mapas/$servidor->categoria.jpg")}}"
                             alt="Mirage"/></figure>
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
                    <div class="card-actions justify-end">
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
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>

