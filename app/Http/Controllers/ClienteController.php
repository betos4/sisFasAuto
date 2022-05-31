<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use App\Models\EstadoCivil;
use App\Models\Direccion;
use App\Models\Referencia;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $clientes = Cliente::all();

        return view('clientes.index')->with([
            'clientes' => $clientes,
        ]);
    }

    public function create() {
        //TODO
    }

    public function store(ClienteRequest $request) {
        //TODO
    }

    public function show(Cliente $cliente) {
        return view('clientes.show')->with([
            'cliente' => $cliente,
        ]);
    }

    public function edit(Cliente $cliente) {
        $estadoCiviles = EstadoCivil::where('estado_activo', '=', true)->get();

        $direcciones = Direccion::select('direcciones.*', 'cantones.nombre AS canton', 'provincias.nombre AS provincia')
        ->leftJoin('cantones', 'cantones.id', '=', 'direcciones.cantonid')
        ->leftJoin('provincias', 'provincias.id', '=', 'cantones.provinciaid')
        ->where('direcciones.clienteid', '=', $cliente->id)
        ->get();

        $referencias = Referencia::select('referencias.*', 'tipo_referencias.nombre AS tipo')
        ->join('clientes', 'clientes.id', '=', 'referencias.clienteid')
        ->join('tipo_referencias', 'tipo_referencias.id', '=', 'referencias.tiporeferenciaid')
        ->where('clientes.id', '=', $cliente->id)
        ->get();

        return view('clientes.edit')->with([
            'cliente' => $cliente,
            'estadoCiviles' => $estadoCiviles,
            'direcciones' => $direcciones,
            'referencias' => $referencias,
        ]);
    }

    public function update(ClienteRequest $request, Cliente $cliente) {
        //guardo estadoCivil
        $estadoCivil = EstadoCivil::find($request['estado_civil']);
        $cliente->estadoCivil()->associate($estadoCivil);
        
        $cliente->update($request->validated());

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente) {
        if($cliente->estado_activo) {
            $cliente->estado_activo = 0;
        } else {
            $cliente->estado_activo = 1;
        }
        
        $cliente->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('clientes.index');
    }
}
