<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;

use Oansa\Http\Requests;
use Oansa\Http\Controllers\Controller;
use Oansa\NivelManual;
use Oansa\Manual;
use Oansa\Oansista;
use Oansa\Estacion;
use Oansa\Seccion;
use Illuminate\Routing\Route;
use Auth;
use Session;
use Redirect;
use DB;

class ManualController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
        //$this->middleware('admin');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }
    public function find(Route $route){
        $this->manual = Manual::find($route->getParameter('manual'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fullname = $request->get('fullname');
        $club_id = $request->get('club_id');
        $oansistas = Oansista::filtrar($fullname,$club_id);
        return view('manual.index',compact('oansistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $oansistas = Oansista::obtener($request->get('oansista_id'));

            return view('manual.create',compact('oansistas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oansista_id=$request['oansista_id'];
        $nivel=$request['nivel'];
        if(! Manual::ExisteManual($oansista_id,$nivel))
        {
            switch ($nivel) 
            {   
                case 1:
                    $this->CrearSaltador($oansista_id);
                    break;
                case 2:
                    $this->CrearCaminante($oansista_id);
                    break;
                case 3:
                    $this->CrearEscalador($oansista_id);
                    break;
                case 4:
                    $this->CrearPaloma($oansista_id);
                    break;
                case 5:
                    $this->CrearAguila($oansista_id);
                    break;
                case 6:
                    $this->CrearVenado($oansista_id);
                    break;
                case 7:
                    $this->CrearLeon($oansista_id);
                    break;
            }
            Session::flash('message-success','Manual asignado exitosamente');
            return Redirect::to('/oansista');
        }
        
        else
        {
            Session::flash('message-success','El oansista ya posee este manual asignado');
            return Redirect::to('/oansista');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $fullname = $request->get('fullname');
        $club_id = $request->get('club_id');
        $oansistas = Oansista::filtrar($fullname,$club_id);
        return view('manual.aprobar',compact('oansistas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function aprobar(Request $request)
    {
        $fullname = $request->get('fullname');
        $club_id = $request->get('club_id');
        $oansistas = Oansista::filtrar($fullname,$club_id);
        return view('manual.aprobar',compact('oansistas'));
    }

    public function seleccionar(Request $request)
    {
        $oansista_id = $request->get('oansista_id');
        $oansistas = Oansista::obtener($request->get('oansista_id'));
        $manuales = Manual::where('oansista_id',$oansista_id)->lists('nombre','id');
        //$manuales = Manual::ObtenerManuales($oansista_id);
        return view('manual.seleccionar',compact('oansistas','manuales'));
    }

    public function progreso(Request $request)
    {
        $oansista_id = $request->get('oansista_id');
        $manual_id = $request->get('manual_id');
        $manual = Manual::where('id',$manual_id)->get();
        $estaciones = Estacion::where('manual_id',$manual_id)->get();
        foreach ($estaciones as $estacion)
        {
            $secciones[] = Seccion::where('estacion_id',$estacion->id)->select('*')->get();
        }
        return view('manual/progreso',compact('manual','estaciones','secciones'));
    }

    public function aprobada($manual_id,$oansista_id,$seccion_id)
    {
        Seccion::where('id', $seccion_id)
                ->update(['fechaAprobada'=>'2016/05/07',
                          'lider_cedula'=>Auth::user()->cedula]);
        $manual = Manual::where('id',$manual_id)->get();
        $estaciones = Estacion::where('manual_id',$manual_id)->get();
        foreach ($estaciones as $estacion)
        {
            $secciones[] = Seccion::where('estacion_id',$estacion->id)->select('*')->get();
        }
        return view('manual/progreso',compact('manual','estaciones','secciones'));
    }


    //-------------------
    //Manuales de Chispas
    //-------------------

    //-------------------
    //Manual Saltador
    //-------------------


    public function CrearSaltador($oansista_id)

    {
        $manual_id = Manual::Crear('Saltador',$oansista_id,1);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesSaltador($i));
            switch ($i)
            {
                case 0:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 1:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 2:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 3:
                    for ($j=0; $j<9 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 4:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;        
                case 5:
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    break;
                case 6:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
        
    }

    public function EstacionesSaltador($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango Saltador";
                break;
            case 1:
                return "Joya Roja 1";
                break;
            case 2:
                return "Joya Roja 2";
                break;
            case 3:
                return "Joya Roja 3";
                break;
            case 4:
                return "Joya Roja 4";
                break;
            case 5:
                return "Joya Verde 1";
                break;
            case 6:
                return "Joya Verde 2";
                break;
            case 7:
                return "Joya Verde 3";
                break;
            case 8:
                return "Joya Verde 4";
                break;
            case 9:
                return "La isla del Saltador";
                break;
        }

    }
    //---------
    //Caminante
    //---------

    public function CrearCaminante($oansista_id)

    {
        $manual_id = Manual::Crear('Caminante',$oansista_id,2);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesCaminante($i));
            switch ($i)
            {
                case 0:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 1:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 2:
                    for ($j=0; $j<5 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 3:
                    for ($j=0; $j<10 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 4:
                    for ($j=0; $j<8 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;        
                case 5:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<5 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
    }

    public function EstacionesCaminante($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango Caminante";
                break;
            case 1:
                return "Joya Roja 1";
                break;
            case 2:
                return "Joya Roja 2";
                break;
            case 3:
                return "Joya Roja 3";
                break;
            case 4:
                return "Joya Roja 4";
                break;
            case 5:
                return "Joya Verde 1";
                break;
            case 6:
                return "Joya Verde 2";
                break;
            case 7:
                return "Joya Verde 3";
                break;
            case 8:
                return "Joya Verde 4";
                break;
            case 9:
                return "La pradera del Caminante";
                break;
        }
    }

    //---------
    //Escalador
    //---------

    public function CrearEscalador($oansista_id)

    {
        $manual_id = Manual::Crear('Escalador',$oansista_id,3);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesEscalador($i));
            switch ($i)
            {
                case 0:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 1:
                    for ($j=0; $j<8 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 2:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 3:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 4:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;        
                case 5:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<6 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<1 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
        
    }

    public function EstacionesEscalador($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango Escalador";
                break;
            case 1:
                return "Joya Roja 1";
                break;
            case 2:
                return "Joya Roja 2";
                break;
            case 3:
                return "Joya Roja 3";
                break;
            case 4:
                return "Joya Roja 4";
                break;
            case 5:
                return "Joya Verde 1";
                break;
            case 6:
                return "Joya Verde 2";
                break;
            case 7:
                return "Joya Verde 3";
                break;
            case 8:
                return "Joya Verde 4";
                break;
            case 9:
                return "La cima del Escalador";
                break;
        }
    }
    //-------------------
    //Manuales de Llamas
    //-------------------

    //-------------------
    //Manual Paloma
    //-------------------
    
    public function CrearPaloma($oansista_id)

    {
        $manual_id = Manual::Crear('Paloma',$oansista_id,4);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesPaloma($i));
            switch ($i) 
            {      
                case 5:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;    
                default:
                    for ($j=0; $j<9 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
            
    }

    public function EstacionesPaloma($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango Paloma";
                break;
            case 1:
                return "Ejercicio Bíblico 1";
                break;
            case 2:
                return "Ejercicio Bíblico 2";
                break;
            case 3:
                return "Ejercicio Bíblico 3";
                break;
            case 4:
                return "Ejercicio Bíblico 4";
                break;
            case 5:
                return "Misiones";
                break;
            case 6:
                return "Patriotismo";
                break;
            case 7:
                return "Medio ambiente y salud";
                break;
            case 8:
                return "Servicio";
                break;
            case 9:
                return "El parque de las Palomas";
                break;
        }
    }
    //-------------
    //Manual Aguila
    //-------------

    public function CrearAguila($oansista_id)

    {
        $manual_id = Manual::Crear('Águila',$oansista_id,5);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesLeon($i));
            switch ($i) 
            {
                case 0:
                    for ($j=0; $j<9 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 1:
                    for ($j=0; $j<10 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 2:
                    for ($j=0; $j<9 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 3:
                    for ($j=0; $j<11 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 4:
                    for ($j=0; $j<11 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 5:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
            
    }

    public function EstacionesAguila($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango León";
                break;
            case 1:
                return "Ejercicio Bíblico 1";
                break;
            case 2:
                return "Ejercicio Bíblico 2";
                break;
            case 3:
                return "Ejercicio Bíblico 3";
                break;
            case 4:
                return "Ejercicio Bíblico 4";
                break;
            case 5:
                return "Misiones";
                break;
            case 6:
                return "Patriotismo";
                break;
            case 7:
                return "Medio ambiente y salud";
                break;
            case 8:
                return "Servicio";
                break;
            case 9:
                return "El nido de las Águilas";
                break;
        }
    }

    //---------------------
    //Manuales de antorchas
    //---------------------

    public function CrearVenado($oansista_id)

    {
        $manual_id = Manual::Crear('Venado',$oansista_id,6);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesVenado($i));
            switch ($i) 
            {
                case 0:
                    for ($j=0; $j<12 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 3:
                    for ($j=0; $j<12 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 5:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                default:
                    for ($j=0; $j<11 ; $j++) { 
                        Seccion::Crear($estacion_id,'00/00/0000','0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
    }

    public function EstacionesVenado($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango";
                break;
            case 1:
                return "Ejercicio Bíblico 1";
                break;
            case 2:
                return "Ejercicio Bíblico 2";
                break;
            case 3:
                return "Ejercicio Bíblico 3";
                break;
            case 4:
                return "Ejercicio Bíblico 4";
                break;
            case 5:
                return "Misiones";
                break;
            case 6:
                return "Patriotismo";
                break;
            case 7:
                return "Medio ambiente y salud";
                break;
            case 8:
                return "Servicio";
                break;
            case 9:
                return "El bosque de los Venados";
                break;
        }
    }

    public function CrearLeon($oansista_id)

    {
        $manual_id = Manual::Crear('León',$oansista_id,7);
        $fechaActual = date('Y-m-d H:i:s');
        for($i = 0; $i<10; $i++)
        {
            $estacion_id = Estacion::Crear($manual_id,$this->EstacionesLeon($i));
            switch ($i) 
            {
                case 1:
                    for ($j=0; $j<13 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 4:
                    for ($j=0; $j<13 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 5:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 6:
                    for ($j=0; $j<2 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break; 
                case 7:
                    for ($j=0; $j<4 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 8:
                    for ($j=0; $j<3 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                case 9:
                    for ($j=0; $j<7 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
                default:
                    for ($j=0; $j<11 ; $j++) { 
                        Seccion::Crear($estacion_id,$fechaActual,'0');
                    }
                    break;
            }//Fin del switch que crea las secciones
        }//Fin del for que crea las estaciones
            
    }

    public function EstacionesLeon($nivel)
    {
        switch ($nivel) {
            case 0:
                return "Rango León";
                break;
            case 1:
                return "Ejercicio Bíblico 1";
                break;
            case 2:
                return "Ejercicio Bíblico 2";
                break;
            case 3:
                return "Ejercicio Bíblico 3";
                break;
            case 4:
                return "Ejercicio Bíblico 4";
                break;
            case 5:
                return "Misiones";
                break;
            case 6:
                return "Patriotismo";
                break;
            case 7:
                return "Medio ambiente y salud";
                break;
            case 8:
                return "Servicio";
                break;
            case 9:
                return "La guarida de los Leones";
                break;
        }
    }


}
