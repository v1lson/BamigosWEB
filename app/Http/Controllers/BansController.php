<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBansRequest;
use App\Http\Requests\UpdateBansRequest;
use App\Http\SourceQuery\SourceQuery;
use App\Models\Bans;
use App\Models\Estadistica;
use App\Models\Servidor;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

    public function show($id_servidor, Request $request)
    {
        session(['id_servidor' => $id_servidor]);
        $servidores = Servidor::orderBy('categoria')->get();
        $steamId = $request->query('steamId');
        $estado = $request->query('estado');
        $nombreBusqeuda = $request->query('nombre');
        $bans = Bans::where("id_servidor",$id_servidor)->orderBy('tiempo_inicio', 'desc');
        if (!$steamId == null) {
            $bans = $bans->where('steam_id',$steamId);
        }
        if (!$nombreBusqeuda == null) {
            $bans = $bans->where('nombre',$nombreBusqeuda);
        }
        if ($estado == 'on') {
            $bans = $bans->where('estado',1);
        }
        $bans = $bans->paginate(11);
        return view("paginas.bans", compact("bans","servidores","steamId","estado",'nombreBusqeuda'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $servidor)
    {
        $nombre = $request->input('nombre');
        try {
            $steamId = Estadistica::where('name', $nombre)->orderBy('lastconnect', 'desc')->firstOrFail()->steam;
        } catch (ModelNotFoundException $e) {
            $steamId = 'Error';
        }
        $ban= true;
        session(['id_servidor' => $servidor]);
        $servidor = Servidor::where("id",$servidor)->firstOrFail();
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.castigos", compact("servidores","servidor","nombre","steamId","ban"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $servidorId = $request->input('servidorId');
        $servidor = Servidor::where("id",$servidorId)->firstOrFail();
        $steamId = $request->input('steamId');
        $periodo = $request->input('periodo');
        $nombre = $request->input('nombre');
        $razon = $request->input('razon');
        $moderador = $request->input('moderador');
        $Query = new SourceQuery( );
        $msj ="test";
        try{
            $Query->Connect( $servidor->ip, $servidor->puerto, 3, SourceQuery::SOURCE );
            $Query->SetRconPassword( $servidor->rcon );
            $Query->Rcon('kick '.$nombre);
            $msj = '<h3 class="p-3 bg-green-600 text-white rounded-2xl shadow mt-5 flex"><svg width="24px" height="24px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
                Jugador '.$nombre.' ha sido baneado correctamente</h3>';
        }
        catch( Exception $e ){
            $msj = '<h3 class="p-3 bg-red-600 text-white rounded-2xl shadow mt-5 flex"><svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect id="Icons" x="-704" y="-64" width="1280" height="800" style="fill:none;"></rect> <g id="Icons1" serif:id="Icons"> <g id="Strike"> </g> <g id="H1"> </g> <g id="H2"> </g> <g id="H3"> </g> <g id="list-ul"> </g> <g id="hamburger-1"> </g> <g id="hamburger-2"> </g> <g id="list-ol"> </g> <g id="list-task"> </g> <g id="trash"> </g> <g id="vertical-menu"> </g> <g id="horizontal-menu"> </g> <g id="sidebar-2"> </g> <g id="Pen"> </g> <g id="Pen1" serif:id="Pen"> </g> <g id="clock"> </g> <g id="external-link"> </g> <g id="hr"> </g> <g id="info"> </g> <g id="warning"> </g> <path id="error-circle" d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z"></path> <g id="plus-circle"> </g> <g id="minus-circle"> </g> <g id="vue"> </g> <g id="cog"> </g> <g id="logo"> </g> <g id="radio-check"> </g> <g id="eye-slash"> </g> <g id="eye"> </g> <g id="toggle-off"> </g> <g id="shredder"> </g> <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g> <g id="react"> </g> <g id="check-selected"> </g> <g id="turn-off"> </g> <g id="code-block"> </g> <g id="user"> </g> <g id="coffee-bean"> </g> <g id="coffee-beans"> <g id="coffee-bean1" serif:id="coffee-bean"> </g> </g> <g id="coffee-bean-filled"> </g> <g id="coffee-beans-filled"> <g id="coffee-bean2" serif:id="coffee-bean"> </g> </g> <g id="clipboard"> </g> <g id="clipboard-paste"> </g> <g id="clipboard-copy"> </g> <g id="Layer1"> </g> </g> </g></svg>
                '.$nombre.' no ha sido baneado</h3>';
        }
        finally{
            $Query->Disconnect( );
        }
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.castigos", compact("servidores","servidor","msj"));
    }
    public function kick(Request $request)
    {
        $servidorId = $request->input('servidorId');
        $servidor = Servidor::where("id",$servidorId)->firstOrFail();
        $nombre = $request->input('nombre');
        $Query = new SourceQuery( );
        $msj ="test";
        try{
            $Query->Connect( $servidor->ip, $servidor->puerto, 3, SourceQuery::SOURCE );
            $Query->SetRconPassword( $servidor->rcon );
            $Query->Rcon('kick '.$nombre);
            $msj = '<h3 class="p-3 bg-green-600 text-white rounded-2xl shadow mt-5 flex"><svg width="24px" height="24px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"></path></g></svg>
                Jugador '.$nombre.' ha sido expulsado correctamente</h3>';
        }
        catch( Exception $e ){
            $msj = '<h3 class="p-3 bg-red-600 text-white rounded-2xl shadow mt-5 flex"><svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect id="Icons" x="-704" y="-64" width="1280" height="800" style="fill:none;"></rect> <g id="Icons1" serif:id="Icons"> <g id="Strike"> </g> <g id="H1"> </g> <g id="H2"> </g> <g id="H3"> </g> <g id="list-ul"> </g> <g id="hamburger-1"> </g> <g id="hamburger-2"> </g> <g id="list-ol"> </g> <g id="list-task"> </g> <g id="trash"> </g> <g id="vertical-menu"> </g> <g id="horizontal-menu"> </g> <g id="sidebar-2"> </g> <g id="Pen"> </g> <g id="Pen1" serif:id="Pen"> </g> <g id="clock"> </g> <g id="external-link"> </g> <g id="hr"> </g> <g id="info"> </g> <g id="warning"> </g> <path id="error-circle" d="M32.085,56.058c6.165,-0.059 12.268,-2.619 16.657,-6.966c5.213,-5.164 7.897,-12.803 6.961,-20.096c-1.605,-12.499 -11.855,-20.98 -23.772,-20.98c-9.053,0 -17.853,5.677 -21.713,13.909c-2.955,6.302 -2.96,13.911 0,20.225c3.832,8.174 12.488,13.821 21.559,13.908c0.103,0.001 0.205,0.001 0.308,0Zm-0.282,-4.003c-9.208,-0.089 -17.799,-7.227 -19.508,-16.378c-1.204,-6.452 1.07,-13.433 5.805,-18.015c5.53,-5.35 14.22,-7.143 21.445,-4.11c6.466,2.714 11.304,9.014 12.196,15.955c0.764,5.949 -1.366,12.184 -5.551,16.48c-3.672,3.767 -8.82,6.016 -14.131,6.068c-0.085,0 -0.171,0 -0.256,0Zm-12.382,-10.29l9.734,-9.734l-9.744,-9.744l2.804,-2.803l9.744,9.744l10.078,-10.078l2.808,2.807l-10.078,10.079l10.098,10.098l-2.803,2.804l-10.099,-10.099l-9.734,9.734l-2.808,-2.808Z"></path> <g id="plus-circle"> </g> <g id="minus-circle"> </g> <g id="vue"> </g> <g id="cog"> </g> <g id="logo"> </g> <g id="radio-check"> </g> <g id="eye-slash"> </g> <g id="eye"> </g> <g id="toggle-off"> </g> <g id="shredder"> </g> <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g> <g id="react"> </g> <g id="check-selected"> </g> <g id="turn-off"> </g> <g id="code-block"> </g> <g id="user"> </g> <g id="coffee-bean"> </g> <g id="coffee-beans"> <g id="coffee-bean1" serif:id="coffee-bean"> </g> </g> <g id="coffee-bean-filled"> </g> <g id="coffee-beans-filled"> <g id="coffee-bean2" serif:id="coffee-bean"> </g> </g> <g id="clipboard"> </g> <g id="clipboard-paste"> </g> <g id="clipboard-copy"> </g> <g id="Layer1"> </g> </g> </g></svg>
                '.$nombre.' no ha sido expulsado</h3>';
        }
        finally{
            $Query->Disconnect( );
        }
        $servidores = Servidor::orderBy('categoria')->get();
        return view("paginas.castigos", compact("servidores","servidor","msj"));
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
    public function update($id, $user)
    {
        $ban = Bans::where("id",$id)->first();
        $timestamp = time();
        $ban->tiempo_final = $timestamp;
        $ban->nombre_penalizador = $user;
        $ban->save();
        return redirect()->route('Bans.show', session('id_servidor'))->with([
            'id_servidor' => session('id_servidor'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bans $bans)
    {
        //
    }
}
