<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolUserRequest;
use App\Http\Requests\UpdateRolUserRequest;
use App\Models\RolUser;
use App\Models\User;

class RolUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RolUser::all();
        return view('paginas.roles', compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = RolUser::all();
        $crear='';
        return view('paginas.roles', compact('roles','crear'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolUserRequest $request)
    {
        $rol = new RolUser();
        $rol->fill($request->input());
        $rol->save();
        $roles = RolUser::all();
        return redirect()->route('Roles.index')->with('roles', $roles);
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $rolMod = RolUser::where('id', $id)->get();
        $roles = RolUser::all();
        return view("paginas.roles", compact("rolMod", "roles"));
    }
    public function showAddUser($id)
    {
        $rolAddUser = RolUser::find($id);
        $roles = RolUser::all();
        return view("paginas.roles", compact("rolAddUser", "roles"));
    }
    public function showAllUsers($id)
    {
        $users = User::where('rol', $id)->get();
        $roles = RolUser::all();
        return view("paginas.roles", compact("users", "roles"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolUserRequest $request,  $id)
    {
        $rol = RolUser::where('id', $id)->first();
        $rol->fill($request->input());
        $rol->save();
        $roles = RolUser::all();
        $rolMod = RolUser::where('id', $id)->get();
        return view('paginas.roles', compact('rolMod','roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolUser $rolUser)
    {
        //
    }
}
