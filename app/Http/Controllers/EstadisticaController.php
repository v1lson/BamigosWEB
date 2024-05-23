<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadisticaRequest;
use App\Http\Requests\UpdateEstadisticaRequest;
use App\Models\Estadistica;
use App\Models\Servidor;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $servidores[0]->id]);
        $estadisticas = Estadistica::where("id_server",$servidores[0]->id)->orderBy('value', 'desc')->paginate(8);
        return view("paginas.estadistica", compact("estadisticas"), compact("servidores"));
    }

    public function show($id_servidor, $order_by, $orden, Request $request)
    {
        $steamId = $request->query('steamId');
        $nombreBusqeuda = $request->query('nombre');
        session(['id_servidor' => $id_servidor]);
        if (session('order_by') === $order_by) {
            if ($orden === 'desc') {
                session(['orden' => 'asc']);
            } else {
                session(['orden' => 'desc']);
            }
        }else{
            session(['order_by' => $order_by]);
            $orden = 'desc';
            session(['orden' => 'asc']);
        }
        $servidores = Servidor::orderBy('categoria')->get();
        $estadisticas = Estadistica::where("id_server",$id_servidor);
        if (!$steamId == null) {
            $estadisticas = $estadisticas->where('steam','like', '%'.$steamId.'%');
        }
        if (!$nombreBusqeuda == null) {
            $estadisticas = $estadisticas->where('name','like', '%'.$nombreBusqeuda.'%');
        }
        $estadisticas = $estadisticas->orderBy($order_by , $orden)->paginate(8);
        return view("paginas.estadistica", compact("estadisticas",'servidores','steamId','nombreBusqeuda'));
    }
    /**

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
    public function store(StoreEstadisticaRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estadistica $estadistica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadisticaRequest $request, Estadistica $estadistica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadistica $estadistica)
    {
        //
    }
}
