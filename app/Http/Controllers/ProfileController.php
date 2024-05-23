<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Bans;
use App\Models\Estadistica;
use App\Models\Mute;
use App\Models\RolUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        $steamStat = $usuario->steamStat;
        $buscar = explode(":", $steamStat);

        $datos = Estadistica::where('steam', 'LIKE', "%{$buscar[2]}")->get();
        $rol = RolUser::select('nombre')->where('id',$usuario->rol)->value('nombre');
        $bans = Bans::where('steam_id',$usuario->steamStat)->orderBy('tiempo_inicio','desc')->get();
        $mutes = Mute::where('steam_id',$usuario->steamStat)->orderBy('tiempo_inicio','desc')->get();
        return view('profile.show', compact('usuario','datos','rol','bans','mutes'));
    }

    public function showAdmins()
    {
        $admins = User::where('rol',1)->get();
        $moders = User::where('rol',3)->get();
        return view('paginas.admins', compact('admins','moders'));
    }
    /**
     * Display the user's profile form.
     */

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $id = $request->input('idUser');
        $rol = $request->input('rol');
        $user = User::find($id);
        if ($user != null) {
            $user->rol = $rol;
            $user->save();
        }
        $rolAddUser = RolUser::find($rol);
        $roles = RolUser::all();
        return redirect()->route('Roles.index')->with([
            'roles' => $roles,
            'rolAddUser' => $rolAddUser
        ]);
    }

    /**
     * Delete the user's account.
     */
}
