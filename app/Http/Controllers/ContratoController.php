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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
            DB::beginTransaction();
                //actualizar cliente
                $cliente = Cliente::findOrFail($request->clienteid);
                $cliente->email = $request->email;
                $cliente->telefono = $request->telefono;
                $cliente->celular = $request->celular;
                $cliente->estadocivilid = $request->estado_civil;
                $cliente->update();

                //actualizar credito
                $credito = Credito::findOrFail($request->creditoid);
                $credito->indicador_propia = 1;
                $credito->update();
                
                $contrato = Contrato::create($request->validated());

                //actualizo con los paths de los archivos
                //VERIFICO SI EXISTE PATH SINO LO CREA
                if (!File::exists(public_path("\documentos\contratos\\".$contrato->id))) {
                    File::makeDirectory(public_path("\documentos\contratos\\".$contrato->id));
                }

                //PATH DONDE SE GUARDAN LOS ARCHIVOS
                $path ='documentos/contratos/'.$contrato->id;
                $savePath = public_path($path);

                //Archivo identificacion
                if($request->hasFile('pathidentificacion')) {
                    $archivo = $request->file('pathidentificacion');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathidentificacion = $path . '/' . $nombreArchivo;
                }

                //Archivo planilla
                if($request->hasFile('pathplanilla')) {
                    $archivo = $request->file('pathplanilla');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathplanilla = $path . '/' . $nombreArchivo;
                }

                //Archivo facturaVehiculo
                if($request->hasFile('pathfacturavehiculo')) {
                    $archivo = $request->file('pathfacturavehiculo');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathfacturavehiculo = $path . '/' . $nombreArchivo;
                }

                //Archivo pathtablaAmortizacion
                if($request->hasFile('pathtablaamortizacion')) {
                    $archivo = $request->file('pathtablaamortizacion');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathtablaamortizacion = $path . '/' . $nombreArchivo;
                }

                //Archivo pathPagare
                if($request->hasFile('pathpagare')) {
                    $archivo = $request->file('pathpagare');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathpagare = $path . '/' . $nombreArchivo;
                }

                $contrato->update();
            DB::commit();
            
            toastr()->success('Registro guardado correctamente');
            return redirect()->route('contratos.index');
        } catch(ModelNotFoundException $err){
            toastr()->error('El registro no pudo ser guardado. Contactate con el Administrador');
        } catch(Exception $e) {
            toastr()->error('El registro no pudo ser guardado. Contactate con el Administrador');
            DB::rollback();
        }
    }

    public function show(Contrato $contrato) {
        //TODO
    }

    public function edit(Contrato $contrato) {
        //variables
        $dispositivos = null;
        $seguros = null;

        $credito = $contrato->credito;
        $estadoCiviles = EstadoCivil::where('estado_activo', '=', true)->get();
        $tipoReferencias = TipoReferencia::where('estado_activo', '=', true)->get();
        $cliente = $credito->cliente;
        $direcciones = Direccion::select('direcciones.*', 'cantones.nombre AS canton', 'provincias.nombre AS provincia')
        ->leftJoin('cantones', 'cantones.id', '=', 'direcciones.cantonid')
        ->leftJoin('provincias', 'provincias.id', '=', 'cantones.provinciaid')
        ->where('direcciones.clienteid', '=', $cliente->id)
        ->get();

        $vehiculo = Vehiculo::where('creditoid', '=', $credito->id)->first();
        if($vehiculo) {
            $dispositivos = $vehiculo->dispositivos;
            $seguros = $vehiculo->seguros;
        } 
        
        return view('contratos.edit')->with([
            'contrato' => $contrato,
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

    public function update(ContratoRequest $request, Contrato $contrato) {
        try{
            DB::beginTransaction();
                //actualizar cliente
                $cliente = Cliente::findOrFail($request->clienteid);
                $cliente->email = $request->email;
                $cliente->telefono = $request->telefono;
                $cliente->celular = $request->celular;
                $cliente->estadocivilid = $request->estado_civil;
                $cliente->update();

                $contrato->update($request->validated());

                //actualizo con los paths de los archivos
                //VERIFICO SI EXISTE PATH SINO LO CREA
                if (!File::exists(public_path("\documentos\contratos\\".$contrato->id))) {
                    File::makeDirectory(public_path("\documentos\contratos\\".$contrato->id));
                }

                //PATH DONDE SE GUARDAN LOS ARCHIVOS
                $path ='documentos/contratos/'.$contrato->id;
                $savePath = public_path($path);

                //Archivo identificacion
                if($request->hasFile('pathidentificacion')) {
                    $archivo = $request->file('pathidentificacion');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathidentificacion = $path . '/' . $nombreArchivo;
                }

                //Archivo planilla
                if($request->hasFile('pathplanilla')) {
                    $archivo = $request->file('pathplanilla');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathplanilla = $path . '/' . $nombreArchivo;
                }

                //Archivo facturaVehiculo
                if($request->hasFile('pathfacturavehiculo')) {
                    $archivo = $request->file('pathfacturavehiculo');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathfacturavehiculo = $path . '/' . $nombreArchivo;
                }

                //Archivo pathtablaAmortizacion
                if($request->hasFile('pathtablaamortizacion')) {
                    $archivo = $request->file('pathtablaamortizacion');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathtablaamortizacion = $path . '/' . $nombreArchivo;
                }

                //Archivo pathPagare
                if($request->hasFile('pathpagare')) {
                    $archivo = $request->file('pathpagare');
                    $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
                    //$archivo->move(public_path().'/archivos/', $nombreArchivo);
                    $archivo->move($savePath, $nombreArchivo);
        
                    $contrato->pathpagare = $path . '/' . $nombreArchivo;
                }

                $contrato->update();
            DB::commit();
            
            toastr()->success('Registro actualizado correctamente');
            return redirect()->route('contratos.index');
        } catch(ModelNotFoundException $err){
            toastr()->error('El registro no pudo ser actualizado. Contactate con el Administrador');
        } catch(Exception $e) {
            toastr()->error('El registro no pudo ser guardado. Contactate con el Administrador');
            DB::rollback();
        }
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

    public function print(Contrato $contrato) {
        try {
            //variables
            $dispositivos = null;
            $seguros = null;

            $credito = $contrato->credito;
            $cliente = $credito->cliente;
            $direccion = Direccion::select('direcciones.*', 'cantones.nombre AS canton', 'provincias.nombre AS provincia')
            ->leftJoin('cantones', 'cantones.id', '=', 'direcciones.cantonid')
            ->leftJoin('provincias', 'provincias.id', '=', 'cantones.provinciaid')
            ->where('direcciones.clienteid', '=', $cliente->id)
            ->first();

            $vehiculo = Vehiculo::where('creditoid', '=', $credito->id)->first();

            $template = new \PhpOffice\PhpWord\TemplateProcessor('contrato_riego_cero.docx');
            //variables
            $template->setValue('num_contrato', $contrato->numcontrato);
            $template->setValue('nombre_cliente', $cliente->nombre);
            $template->setValue('identificacion_cliente', $cliente->rut);
            $template->setValue('celular_cliente', $cliente->celular);
            $template->setValue('telefono_cliente', $cliente->telefono);
            $template->setValue('correo_cliente', $cliente->email);
            $template->setValue('direccion_cliente', $direccion->direccion);
            $template->setValue('sector_cliente', $direccion->sector);
            $template->setValue('ciudad_cliente', 'SIN CIUDAD');
            $template->setValue('provincia_cliente', 'SIN PROVINCIA');
            $template->setValue('fecha_inicio', $contrato->fechainicio);
            $template->setValue('fecha_fin', $contrato->fechafin);
            $template->setValue('marca_vehiculo', $vehiculo->marca);
            $template->setValue('chasis_vehiculo', $vehiculo->chasis);
            $template->setValue('anio_vehiculo', $vehiculo->anio);
            $template->setValue('modelo_vehiculo', $vehiculo->modelo);
            $template->setValue('motor_vehiculo', $vehiculo->motor);
            $template->setValue('placa_vehiculo', $vehiculo->placa);
            $template->setValue('color_vehiculo', $vehiculo->color);
    
            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);
    
            $headers = [
                "Content-Type: application/octet-stream",
            ];
    
            return response()->download($tempFile, 'contrato.docx', $headers)->deleteFileAfterSend(true);
        } catch(\PhpOffice\PhpWord\Exception\Exception $e) {
            return back($e->getCode());
        }
    }

    public function consult(Request $request) {
        $date = Carbon::now();
        $anio = $date->format('Y');
        $mes = $date->format('m');
        $dia = $date->format('d');

        $actuales = Contrato::whereYear('created_at', '=', $anio)
        ->whereMonth('created_at', '=', $mes)
        ->whereDay('created_at', '=', $dia)
        ->where('estado_activo', '=', '1')
        ->count();

        $mensuales = Contrato::whereYear('created_at', '=', $anio)
        ->whereMonth('created_at', '=', $mes)
        ->where('estado_activo', '=', '1')
        ->count();

        $plazo = Contrato::selectRaw('SUM(DATEDIFF(year,fechainicio,fechafin)) as anios')
        ->whereYear('created_at', '=', $anio)
        ->whereMonth('created_at', '=', $mes)
        ->where('estado_activo', '=', '1')
        ->first();

        $valorCredito = Contrato::whereYear('created_at', '=', $anio)
        ->whereMonth('created_at', '=', $mes)
        ->where('estado_activo', '=', '1')
        ->sum('valorgarantia');

        $contratosPorDia = Contrato::selectRaw('DAY(created_at) as dia, COUNT(id) as numcontrato')
        ->whereYear('created_at', '=', $anio)
        ->whereMonth('created_at', '=', $mes)
        ->where('estado_activo', '=', '1')
        ->groupByRaw('DAY(created_at)')
        ->get();

        $marcas = Contrato::selectRaw('vehiculos.marca as marca, COUNT(contratos.id) as numcontrato')
        ->join('creditos', 'creditos.id', '=', 'contratos.creditoid')
        ->join('vehiculos', 'vehiculos.creditoid', '=', 'creditos.id')
        ->whereYear('contratos.created_at', '=', $anio)
        ->whereMonth('contratos.created_at', '=', $mes)
        ->where('contratos.estado_activo', '=', '1')
        ->groupBy('vehiculos.marca')
        ->get();

        /*print($marcas);
        dd();*/

        return response()->json([
            'actuales' => $actuales,
            'mensuales' => $mensuales,
            'plazo' => $plazo->anios,
            'valorCredito' => $valorCredito,
            'contratosPorDia' => $contratosPorDia,
            'marcas' => $marcas,
         ]);
    }
}
