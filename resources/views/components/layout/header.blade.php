@php use App\Models\RolUser; @endphp
<header class="hidden bg-principal text-white sm:flex flex-row justify-around items-center h-[70px]">
    <div class="navbar">
        <div class="flex-1">
            <a href="/" class="btn btn-ghost text-xl">
                <img class="h-10 fill-white" src="{{asset("images/logo.png")}}" alt="logo"/>
                <h1>Bamigos</h1>
            </a>
        </div>
        @guest
            <a href="/login">
                <button class="btn btn-ghost bg-orange-700">
                    <svg width="24px" height="24px" viewBox="-1.5 0 259 259" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M127.778579,0 C60.4203546,0 5.24030561,52.412282 0,119.013983 L68.7236558,147.68805 C74.5451924,143.665561 81.5845466,141.322185 89.1497766,141.322185 C89.8324924,141.322185 90.5059824,141.340637 91.1702465,141.377541 L121.735621,96.668877 L121.735621,96.0415165 C121.735621,69.1388208 143.425688,47.2457835 170.088511,47.2457835 C196.751333,47.2457835 218.441401,69.1388208 218.441401,96.0415165 C218.441401,122.944212 196.751333,144.846475 170.088511,144.846475 C169.719475,144.846475 169.359666,144.83725 168.99063,144.828024 L125.398299,176.205276 C125.425977,176.786507 125.444428,177.367738 125.444428,177.939743 C125.444428,198.144443 109.160732,214.575753 89.1497766,214.575753 C71.5836817,214.575753 56.8868387,201.917832 53.5655182,185.163615 L4.40997549,164.654462 C19.6326942,218.967277 69.0834655,258.786219 127.778579,258.786219 C198.596511,258.786219 256,200.847629 256,129.393109 C256,57.9293643 198.596511,0 127.778579,0 Z M80.3519677,196.332478 L64.6033732,189.763644 C67.389592,195.63131 72.2239585,200.539484 78.6359521,203.233444 C92.4932392,209.064206 108.472481,202.430791 114.247888,188.435116 C117.043333,181.663313 117.061785,174.190342 114.294018,167.400086 C111.526251,160.609831 106.295171,155.31417 99.5879487,152.491048 C92.9176301,149.695603 85.7767911,149.797088 79.5031858,152.186594 L95.777656,158.976849 C105.999942,163.276114 110.834309,175.122157 106.571948,185.436702 C102.318812,195.751247 90.574254,200.631743 80.3519677,196.332478 Z M202.30901,96.0424391 C202.30901,78.1165345 187.85204,63.5211763 170.092201,63.5211763 C152.323137,63.5211763 137.866167,78.1165345 137.866167,96.0424391 C137.866167,113.968344 152.323137,128.554476 170.092201,128.554476 C187.85204,128.554476 202.30901,113.968344 202.30901,96.0424391 Z M145.938821,95.9870838 C145.938821,82.4988323 156.779242,71.5661525 170.138331,71.5661525 C183.506646,71.5661525 194.347066,82.4988323 194.347066,95.9870838 C194.347066,109.475335 183.506646,120.408015 170.138331,120.408015 C156.779242,120.408015 145.938821,109.475335 145.938821,95.9870838 Z" fill="#ffffff"> </path> </g> </g></svg>
                    Login</button>
            </a>
        @endguest
        @auth
        <div class="flex-none text-texto">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost avatar">
                   <span class="text-white text-right font-light">
                       <b class="font-bold">{{auth()->user()->name}}</b>
                   <br>
                       {{RolUser::select('nombre')->where('id',auth()->user()->rol)->value('nombre')}}
                   </span>
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component" src="{{auth()->user()->avatar}}" />
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a href="{{ route('profile.show', ['id' => auth()->user()->id]) }}" class="justify-between">
                          Mi Perfil
                        </a>
                    </li>
                    <li><a> <form action="{{route("logout")}}" method="post">
                                @csrf
                                <button class="" type="submit">Logout</button>
                            </form></a></li>
                </ul>
            </div>
        </div>
        @endauth
    </div>
</header>
