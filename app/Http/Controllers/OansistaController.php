<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;
use Oansa\Oansista;
use Oansa\Http\Requests;
use Oansa\Http\Requests\OansistaRequest;
use Oansa\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Session;
use Redirect;
use Auth;

class OansistaController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
        //$this->middleware('admin');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }
    public function find(Route $route){
        $this->oansista = Oansista::find($route->getParameter('oansista'));
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
        return view('oansista.index',compact('oansistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('oansista.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OansistaRequest $request)
    {
        $nombre=$request['nombre'];
        $apellido=$request['apellido'];
        $fechaNacimiento=$request['fechaNacimiento'];
        $grado=$request['grado'];
        $sexo=$request['sexo']; 
        $direccion=$request['direccion'];
        $telefono=$request['telefono'];
        $representante=$request['representante'];
        $telefonoRepresentante=$request['telefonoRepresentante'];
        $iglesia=$request['iglesia'];
        Oansista::create([
            'nombre'=>$nombre,
            'apellido'=>$apellido,
            'fullname'=>$nombre." ".$apellido,
            'fechaNacimiento'=>$fechaNacimiento,
            'grado'=>$grado,
            'sexo'=>$sexo,
            'direccion'=>$direccion,
            'telefono'=>$telefono,
            'representante'=>$representante,
            'telefonoRepresentante'=>$telefonoRepresentante,
            'iglesia'=>$iglesia,
            'estatus' => '1',
            ]);
        Session::flash('message-success','Oansista registrado exitosamente');
        return Redirect::to('/oansista');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('oansista.edit',['oansista'=>$this->oansista]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $this->oansista->fill($request->all());
        $this->oansista->save();
        Session::flash('message-success','Oansista Actualizado Correctamente');
        return Redirect::to('/oansista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->oansista->delete();
        Session::flash('message-success','Oansista Eliminado Correctamente');
        return Redirect::to('/oansista');
    }
}
