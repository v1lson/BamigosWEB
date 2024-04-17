@extends("layouts.layout")

@section("contenido")
    <div class="carousel w-2/3 h-24">
        <div id="slide1" class="carousel-item relative w-full">
            <img src="https://daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.jpg" class="w-full" />
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide4" class="btn btn-circle">❮</a>
                <a href="#slide2" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide2" class="carousel-item relative w-full">
            <img src="https://daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.jpg" class="w-full" />
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide1" class="btn btn-circle">❮</a>
                <a href="#slide3" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide3" class="carousel-item relative w-full">
            <img src="https://daisyui.com/images/stock/photo-1414694762283-acccc27bca85.jpg" class="w-full" />
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide2" class="btn btn-circle">❮</a>
                <a href="#slide4" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide4" class="carousel-item relative w-full">
            <img src="https://daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.jpg" class="w-full" />
            <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                <a href="#slide3" class="btn btn-circle">❮</a>
                <a href="#slide1" class="btn btn-circle">❯</a>
            </div>
        </div>
    </div>
    <img src="{{asset("images/Main_person.png")}}" alt="" class="w-[354px] h-[326px] float-right">
   <div class=" mt-5 text-center">
       <ul class="menu menu-vertical lg:menu-horizontal bg-base-200 rounded-box">
           <li><a>Todos</a></li>
           <li><a>Mirage</a></li>
           <li><a>Dust II</a></li>
       </ul>
       <br>
       <div class="mt-3 flex place-content-evenly">
           <div class="card w-80 h-12 bg-base-100 shadow-l image-full p-0">
               <figure><img class="w-full" src="https://www.esports.net/wp-content/uploads/2023/10/Mirage-CS2-2.jpg" alt="Shoes" /></figure>
               <div class="card-body flex">
                   <h2 class="card-title"> ONLY Mirage#1</h2>
                   <div class="card-actions justify-end">
                       <button class="btn btn-ghost">Conectar</button>
                   </div>
               </div>
           </div>
           <div class="card w-80 h-12 bg-base-100 shadow-l image-full p-0">
               <figure><img class="w-full" src="https://www.esports.net/wp-content/uploads/2023/10/Mirage-CS2-2.jpg" alt="Shoes" /></figure>
               <div class="card-body">
                   <h2 class="card-title"> ONLY Mirage#1</h2>
                   <div class="card-actions justify-end">
                       <button class="btn btn-ghost">Conectar</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection
@section("titulo")
    proyecto laravel
@endsection
@section("descripcion")
    Proyecto de aprendizaje de laravel. usamos los diferentes elementos
@endsection
