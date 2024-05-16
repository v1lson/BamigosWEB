<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Models\Log;
use App\Models\Servidor;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $servidores[0]->id]);
        $logs = Log::where('id_servidor', session('id_servidor'))->orderBy('tiempo','desc')->paginate(100);
        $tipos = Log::select('tipo')->distinct('tipo')->get();
        return view('paginas.logs', compact('servidores','logs','tipos'));
    }
    public function show($id_servidor)
    {
        $servidores = Servidor::orderBy('categoria')->get();
        session(['id_servidor' => $id_servidor]);
        $logs = Log::where('id_servidor', session('id_servidor'))->orderBy('tiempo','desc')->paginate(100);
        return view('paginas.logs', compact('servidores','logs'));
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
