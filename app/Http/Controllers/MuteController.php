<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMuteRequest;
use App\Http\Requests\UpdateMuteRequest;
use App\Models\Mute;
use App\Models\Servidor;

class MuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $servidores[0]->id]);
        $mutes = Mute::where("id_servidor",$servidores[0]->id)->orderBy('tiempo_inicio', 'desc')->paginate(11);
        return view("paginas.mute", compact("mutes"), compact("servidores"));
    }
    public function show($id_servidor)
    {
        session(['id_servidor' => $id_servidor]);
        $servidores = Servidor::orderBy('categoria')->get();
        $mutes = Mute::where("id_servidor",$id_servidor)->orderBy('tiempo_inicio', 'desc')->paginate(11);
        return view("paginas.mute", compact("mutes"), compact("servidores"));
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
    public function store(StoreMuteRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mute $mute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMuteRequest $request, Mute $mute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mute $mute)
    {
        //
    }
}
