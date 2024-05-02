<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBansRequest;
use App\Http\Requests\UpdateBansRequest;
use App\Models\Bans;
use App\Models\Servidor;

class BansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $servidores[0]->id]);
        $bans = Bans::where("id_servidor",$servidores[0]->id)->orderBy('tiempo_inicio', 'desc')->paginate(11);
        return view("paginas.bans", compact("bans"), compact("servidores"));
    }

    public function show($id_servidor)
    {
        session(['id_servidor' => $id_servidor]);
        $servidores = Servidor::orderBy('categoria')->get();
        $bans = Bans::where("id_servidor",$id_servidor)->orderBy('tiempo_inicio', 'desc')->paginate(11);
        return view("paginas.bans", compact("bans"), compact("servidores"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBansRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bans $ban)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBansRequest $request, Bans $bans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bans $bans)
    {
        //
    }
}
