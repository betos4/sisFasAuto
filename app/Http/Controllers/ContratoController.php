<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Http\Requests\ContratoRequest;
use App\Models\Credito;
use App\Models\EstadoCivil;
use App\Models\Direccion;
use App\Models\TipoReferencia;
use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $contratos = Contrato::select('contratos.*', 'creditos.noperacion AS operacion', 'clientes.rut AS identificacion', 'clientes.nombre AS nombreCliente')
        ->join('creditos', 'creditos.id', '=', 'contratos.creditoid')
        ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
        ->get();

        return view('contratos.index')->with([
            'contratos' => $contratos,
        ]);
    }

    public function create($idCredito) {
        try{
            //variables
            $dispositivos = null;
            $seguros = null;

            $credito = Credito::findOrFail($idCredito);
            $estadoCiviles = EstadoCivil::where('estado_activo', '=', true)->get();
            $tipoReferencias = TipoReferencia::where('estado_activo', '=', true)->get();
            $cliente = $credito->cliente;
            $direcciones = Direccion::select('direcciones.*', 'cantones.nombre AS canton', 'provincias.nombre AS provincia')
            ->leftJoin('cantones', 'cantones.id', '=', 'direcciones.cantonid')
            ->leftJoin('provincias', 'provincias.id', '=', 'cantones.provinciaid')
            ->where('direcciones.clienteid', '=', $cliente->id)
            ->get();

            $vehiculo = Vehiculo::where('creditoid', '=', $idCredito)->first();
            if($vehiculo) {
                $dispositivos = $vehiculo->dispositivos;
                $seguros = $vehiculo->seguros;
            } 

            return view('contratos.create')->with([
                'credito' => $credito,
                'estadoCiviles' => $estadoCiviles,
                'tipoReferencias' => $tipoReferencias,
                'cliente' => $cliente,
                'direcciones' => $direcciones,
                'vehiculo' => $vehiculo,
                'dispositivos' => $dispositivos,
                'seguros' => $seguros,
            ]);
        }
        catch(ModelNotFoundException $err){
            return redirect()->route('contratos.index');
        }
    }

    public function store(ContratoRequest $request) {
        try{
            //actualizar cliente
            $cliente = Cliente::findOrFail($request->clienteid);
            $cliente->email = $request->email;
            $cliente->telefono = $request->telefono;
            $cliente->celular = $request->celular;
            $cliente->estadocivilid = $request->estado_civil;
            $cliente->update();
            
            $contrato = Contrato::create($request->validated());
            
            toastr()->success('Registro guardado correctamente');
            return redirect()->route('contratos.index');
        }
        catch(ModelNotFoundException $err){
            toastr()->error('El registro no pudo ser guardado. Contactate con el Administrador');
        }  
        
    }

    //funcion que actualiza el cliente
    protected function updateCliente(ContratoRequest $request) {
        $cliente = User::findOrFail($id);
        $user->password = 'Sis2022$$';
        $user->update();
    }

    public function show(Contrato $contrato) {
        //TODO
    }

    public function edit(Contrato $contrato) {
        //TODO
    }

    public function update(ContratoRequest $request, Contrato $contrato) {
        //TODO
    }

    public function destroy(Contrato $contrato) {
        if($contrato->estado_activo) {
            $contrato->estado_activo = 0;
        } else {
            $contrato->estado_activo = 1;
        }
        
        $contrato->update();

        toastr()->success('Registro actualizado correctamente');
        return redirect()->route('contratos.index');
    }

    public function findContract() {
        return view('contratos.search');
    }

    public function search(Request $request) {
        $registros = null;

        if($request->keyword != ''){
            $registros = Credito::select('creditos.noperacion AS operacion', 'creditos.id AS id', 'clientes.nombre AS nombre', 'clientes.rut AS identificacion')
            ->join('clientes', 'clientes.id', '=', 'creditos.clienteid')
            ->where('creditos.rut', 'LIKE', '%'.$request->keyword.'%')
            ->where('clientes.estado_activo', '=', 1)
            ->get();
        }

        return response()->json([
            'registros' => $registros
         ]);
    }
}
