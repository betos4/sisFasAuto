<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cuota;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $creditos = Credito::select('creditos.*', 'estado_creditos.nombre AS estado', 'clientes.nombre AS cliente')
        ->join('estado_creditos', 'estado_creditos.id', '=', 'creditos.estadocreditoid')
        ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
        ->get();

//        dd($creditos);

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
        $credit = Credito::select('creditos.*', 'clientes.nombre AS cliente', 'clientes.email AS email')
        ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
        ->where('creditos.id', '=', $credito->id)
        ->first();

        $cuotas = Cuota::select('cuotas.*', 'estado_cuotas.nombre')
        ->join('estado_cuotas', 'estado_cuotas.id', '=', 'cuotas.estadocuotaid')
        ->where('cuotas.creditoid', '=', $credito->id)->get()->sort();

        //dd($cuotas);

        return view('creditos.show')->with([
            'credito' => $credit,
            'cuotas' => $cuotas,
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
