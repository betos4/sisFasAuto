<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $menus = Menu::getMenu();

        return view('menus.index')->with([
            'menus' => $menus,
        ]);
    }

    public function create() {
        return view('menus.create');
    }

    public function store(MenuRequest $request) {
        $menu = Menu::create($request->validated());

        toastr()->success('Registro guardado correctamente');
        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu) {
        return view('menus.edit')->with([
            'menu' => $menu,
        ]);
    }

    public function update(MenuRequest $request, Menu $menu) {
        $menu->update($request->validated());

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('menus.index');
    }

    public function destroy() {
        
    }

    public function saveOrder(Request $request)
    {
        if($request->ajax()){
            $menu = new Menu;
            $menu->saveOrder($request->menu);
            return response()->json(['respuesta' => 'ok'] );
        }else{
            abort(404);
        }
    }
}
