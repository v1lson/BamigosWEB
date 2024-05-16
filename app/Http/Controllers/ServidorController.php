<?php

namespace App\Http\Controllers;

use App\Http\SourceQuery\SourceQuery;
use App\Models\Bans;
use App\Models\Estadistica;
use App\Models\Mute;
use App\Models\Servidor;
use App\Http\Requests\StoreServidorRequest;
use App\Http\Requests\UpdateServidorRequest;
use Exception;

class ServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->take(6)->get();
        return view("main", compact("servidores"));
    }
    public function categoria($cat)
    {
        if ($cat === "Todos"){
            $servidores = Servidor::orderBy('categoria')->take(6)->get();
        }else{
            $servidores = Servidor::where("categoria",$cat)->take(6)->get();
        }

        return view('main', compact('servidores'));
    }

    public function verTodos()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.servidores", compact("servidores"));
    }
    public function verTodosCastigos($id_servidor)
    {
        session(['id_servidor' => $id_servidor]);
        $servidor = Servidor::where("id",$id_servidor)->firstOrFail();
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.castigos", compact("servidores","servidor"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $crear = '';
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.servidores", compact("servidores", "crear"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServidorRequest $request)
    {
        $servidor = new Servidor();
        $servidor->fill($request->input());
        $created_by = $request->input('created_by');
        $servidor->create_by = $created_by;
        $servidor->save();
        $servidores = Servidor::orderBy('categoria')->get();
        return redirect()->route('serviodres.todos')->with('servidores', $servidores);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servidorMod = Servidor::where("id",$id)->firstOrFail();
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.servidores", compact("servidores", "servidorMod"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servidor $servidor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServidorRequest $request, $id)
    {
        $servidor = Servidor::where('id', $id)->first();
        $servidor->fill($request->input());
        $servidor->save();
        $servidores = Servidor::orderBy('categoria')->get();
        $servidorMod = Servidor::where("id",$id)->firstOrFail();
        return view('paginas.servidores', compact('servidorMod','servidores'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($servidor_id)
    {
        Bans::where('id_servidor', $servidor_id)->delete();
        Mute::where('id_servidor', $servidor_id)->delete();
        Estadistica::where('id_server', $servidor_id)->delete();
        $servidor = Servidor::where('id', $servidor_id)->first();
        $servidor->delete();
        return redirect()->route('serviodres.todos');
    }
}
