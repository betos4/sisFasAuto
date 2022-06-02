<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cuota;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        if(session()->get('is_superadministrator_rol') == 1) {
            $creditos = Credito::select('creditos.*', 'vehiculos.marca AS marca', 'vehiculos.modelo AS modelo', 'clientes.nombre AS cliente')
            ->join('vehiculos', 'vehiculos.creditoid', '=', 'creditos.id')
            ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
            ->get();
        } else {
            $creditos = Credito::select('creditos.*', 'vehiculos.marca AS marca', 'vehiculos.modelo AS modelo', 'clientes.nombre AS cliente')
            ->join('vehiculos', 'vehiculos.creditoid', '=', 'creditos.id')
            ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
            ->where('creditos.indicador_propia', '=', true)
            ->get();
        }        

        return view('creditos.index')->with([
            'creditos' => $creditos,
        ]);
    }

    public function create() {
        //TODO
    }

    public function store(UserRequest $request) {
        //TODO
    }

    public function show(Credito $credito) {
        //variables
        $dispositivos = null;
        $seguros = null;

        $credit = Credito::select('creditos.*', 'clientes.nombre AS cliente', 'clientes.email AS email', 'clientes.telefono AS telefono', 'clientes.celular AS celular', 'estado_creditos.nombre AS estadoCredito', 'segments.nombre AS segmento')
        ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
        ->join('estado_creditos', 'estado_creditos.id', '=', 'creditos.estadocreditoid')
        ->join('segments', 'segments.id', '=', 'creditos.segmentoid')
        ->where('creditos.id', '=', $credito->id)
        ->first();

        $cuotas = Cuota::select('cuotas.*', 'estado_cuotas.nombre')
        ->join('estado_cuotas', 'estado_cuotas.id', '=', 'cuotas.estadocuotaid')
        ->where('cuotas.creditoid', '=', $credito->id)->get()->sort();

        $vehiculo = Vehiculo::where('creditoid', '=', $credito->id)->first();

        if($vehiculo) {
            $dispositivos = $vehiculo->dispositivos;
            $seguros = $vehiculo->seguros;
        } 

        return view('creditos.show')->with([
            'credito' => $credit,
            'cuotas' => $cuotas,
            'vehiculo' => $vehiculo,
            'dispositivos' => $dispositivos,
            'seguros' => $seguros,
        ]);
    }

    public function edit(User $user) {
        //TODO
    }

    public function update(UserRequest $request, User $user) {
        //TODO
    }

    public function destroy(User $user) {
        //TODO
    }
}
