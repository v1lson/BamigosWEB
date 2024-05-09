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
        $bans = Bans::where('steam_id',$usuario->steamStat)->get();
        $mutes = Mute::where('steam_id',$usuario->steamStat)->get();
        return view('profile.show', compact('usuario','datos','rol','bans','mutes'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


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
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
