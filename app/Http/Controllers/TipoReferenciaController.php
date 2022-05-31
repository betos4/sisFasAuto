<?php

namespace App\Http\Controllers;

use App\Models\TipoReferencia;
use App\Http\Requests\TipoReferenciaRequest;
use Illuminate\Http\Request;

class TipoReferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $tipoReferencias = TipoReferencia::all();

        return view('tipoReferencias.index')->with([
            'tipoReferencias' => $tipoReferencias,
        ]);
    }

    public function create() {
        return view('tipoReferencias.create');
    }

    public function store(TipoReferenciaRequest $request) {
        $tipoReferencia = TipoReferencia::create($request->validated());

        toastr()->success('Registro guardado correctamente');
        return redirect()->route('tipoReferencias.index');
    }

    public function show() {
        //TODO
    }

    public function edit(TipoReferencia $tipoReferencia) {
        return view('tipoReferencias.edit')->with([
            'tipoReferencia' => $tipoReferencia,
        ]);
    }

    public function update(TipoReferenciaRequest $request, TipoReferencia $tipoReferencia) {
        $tipoReferencia->update($request->validated());

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('tipoReferencias.index');
    }

    public function destroy(TipoReferencia $tipoReferencia) {
        if($tipoReferencia->estado_activo) {
            $tipoReferencia->estado_activo = 0;
        } else {
            $tipoReferencia->estado_activo = 1;
        }
        
        $tipoReferencia->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('tipoReferencias.index');
    }
}
