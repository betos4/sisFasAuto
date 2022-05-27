<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Rol;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        //$users = User::all();
        if(session()->get('is_superadministrator_rol') == 1) {
            $users = User::select('users.*', 'roles.*')
            ->join('roles_user', 'roles_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'roles_user.rol_id')
            ->get();
        } else {
            $users = User::select('users.*', 'roles.*')
            ->join('roles_user', 'roles_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'roles_user.rol_id')
            ->where('roles.is_superadministrator_rol', '=', false)
            ->get();
        }

        return view('users.index')->with([
            'users' => $users,
        ]);
    }

    public function create() {
        if(session()->get('is_superadministrator_rol') == 1) {
            $roles = Rol::where('status_rol', '=', true)->get();
        } else {
            $roles = Rol::where('status_rol', '=', true)->where('is_superadministrator_rol', '=', false)->get();
        }
        
        return view('users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(UserRequest $request) {
        $user = User::create($request->validated());

        //guardo rol
        $user->roles()->sync($request['rol']);

        toastr()->success('Registro guardado correctamente');
        return redirect()->route('users.index');
    }

    public function show() {
        //TODO
    }

    public function edit(User $user) {
        if(session()->get('is_superadministrator_rol') == 1) {
            $roles = Rol::where('status_rol', '=', true)->get();
        } else {
            $roles = Rol::where('status_rol', '=', true)->where('is_superadministrator_rol', '=', false)->get();
        }

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UserRequest $request, User $user) {
        $user->update($request->validated());

        //guardo rol
        $user->roles()->sync($request['rol']);

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        if($user->status_user) {
            $user->status_user = 0;
        } else {
            $user->status_user = 1;
        }
        
        $user->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('users.index');
    }

    public function password(Request $request) {
        $id = $request->user_id;

        $user = User::findOrFail($id);
        $user->password = 'Sis2022$$';
        $user->update();

        toastr()->success('Contraseña actualizada correctamente');
        return redirect()->route('users.index');
    }
}
