<?php

namespace App\Http\Controllers;

use App\Models\EstadoCivil;
use App\Http\Requests\EstadoCivilRequest;
use Illuminate\Http\Request;

class EstadoCivilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $estadoCiviles = EstadoCivil::all();

        return view('estadoCiviles.index')->with([
            'estadoCiviles' => $estadoCiviles,
        ]);
    }

    public function create() {
        return view('estadoCiviles.create');
    }

    public function store(EstadoCivilRequest $request) {
        $estadoCivil = EstadoCivil::create($request->validated());

        toastr()->success('Registro guardado correctamente');
        return redirect()->route('estadoCiviles.index');
    }

    public function show() {
        //TODO
    }

    public function edit(EstadoCivil $estadoCivil) {
        return view('estadoCiviles.edit')->with([
            'estadoCivil' => $estadoCivil,
        ]);
    }

    public function update(EstadoCivilRequest $request, EstadoCivil $estadoCivil) {
        $estadoCivil->update($request->validated());

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('estadoCiviles.index');
    }

    public function destroy(EstadoCivil $estadoCivil) {
        if($estadoCivil->estado_activo) {
            $estadoCivil->estado_activo = 0;
        } else {
            $estadoCivil->estado_activo = 1;
        }
        
        $estadoCivil->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('estadoCiviles.index');
    }
}
