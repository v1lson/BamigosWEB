<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Models\Log;
use App\Models\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $servidores[0]->id]);
        $logs = Log::where('id_servidor', session('id_servidor'))->orderBy('tiempo','desc')->paginate(90);
        $tipos = Log::select('tipo')->distinct('tipo')->get();
        return view('paginas.logs', compact('servidores','logs','tipos'));
    }
    public function show($id_servidor)
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $id_servidor]);
        $logs = Log::where('id_servidor', session('id_servidor'))->orderBy('tiempo','desc')->paginate(90);
        $tipos = Log::select('tipo')->distinct('tipo')->get();
        return view('paginas.logs', compact('servidores','logs','tipos'));
    }
    public function filtrar(Request $request,$id_servidor)
    {
        $tipoSel = $request->input('tipo');
        $nombreBusqeuda = $request->input('nombre');
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $steamId = $request->input('steamId');
        $desdeFormat = '';
        $hastaFormat = '';
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $id_servidor]);
        $logs = Log::where('id_servidor', session('id_servidor'));
        if ($desde || $hasta) {
            $desdeFormat = $desde ? Carbon::parse($desde)->format('Y-m-d H:i') : null;
            $hastaFormat = $hasta ? Carbon::parse($hasta)->format('Y-m-d H:i') : null;

            if ($desdeFormat && $hastaFormat) {
                $logs = $logs->whereBetween('tiempo', [$desdeFormat, $hastaFormat]);
            } elseif ($desdeFormat) {
                $logs = $logs->where('tiempo', '>=', $desdeFormat);
            } elseif ($hastaFormat) {
                $logs = $logs->where('tiempo', '<=', $hastaFormat);
            }
        }
        if (!$tipoSel == null){
            $logs = $logs->where('tipo','like', '%'.$tipoSel.'%');
        }
        if (!$nombreBusqeuda == null){
            $logs = $logs->where('nombre_jugador','like', '%'.$nombreBusqeuda.'%');
        }
        if (!$steamId == null){
            $logs = $logs->where('steam','like', '%'.$steamId.'%');
        }
        $logs = $logs->orderBy('tiempo','desc')->paginate(90);
        $tipos = Log::select('tipo')->distinct('tipo')->get();
        return view('paginas.logs', compact('servidores','logs','tipos','nombreBusqeuda','steamId','tipoSel','desdeFormat','hastaFormat'));
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
    public function store(StoreLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogRequest $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
