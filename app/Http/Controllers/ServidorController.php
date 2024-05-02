<?php

namespace App\Http\Controllers;

use App\Http\SourceQuery\SourceQuery;
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
    public function store(StoreServidorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Servidor $servidor)
    {
        //
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
    public function update(UpdateServidorRequest $request, Servidor $servidor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servidor $servidor)
    {
        //
    }
}
