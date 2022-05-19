<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rol;
use Illuminate\Http\Request;

class MenuRolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $roles = Rol::orderBy('id')->pluck('name_rol', 'id')->toArray();
        $menus = Menu::getMenu();

        $menusRoles = Menu::with('roles')->get()->pluck('roles', 'id')->toArray();

        return view('menu-rol.index',[
            'roles' => $roles,
            'menus' => $menus,
            'menusRoles' => $menusRoles
        ]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $menus = new Menu();
            if ($request->input('estado') == 1) {
                $menus->find($request->input('menu_id'))->roles()->attach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se asigno correctamente']);
            } else {
                $menus->find($request->input('menu_id'))->roles()->detach($request->input('rol_id'));
                return response()->json(['respuesta' => 'El rol se elimino correctamente']);
            }
        } else {
            abort(404);
        }
    }
}
