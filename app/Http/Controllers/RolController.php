<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $roles = Rol::all();

        return view('roles.index')->with([
            'roles' => $roles,
        ]);
    }

    public function create() {
        return view('roles.create');
    }

    public function store(RolRequest $request) {
        $rol = Rol::create($request->validated());

        toastr()->success('Registro guardado correctamente');
        return redirect()->route('roles.index');
    }

    public function edit(Rol $rol) {
        return view('roles.edit')->with([
            'rol' => $rol,
        ]);
    }

    public function update(RolRequest $request, Rol $rol) {
        $rol->update($request->validated());

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('roles.index');
    }

    public function destroy(Rol $rol) {
        if($rol->status_rol) {
            $rol->status_rol = 0;
        } else {
            $rol->status_rol = 1;
        }
        
        $rol->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('roles.index');
    }
}
