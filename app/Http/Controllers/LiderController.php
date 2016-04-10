<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;

use Oansa\Http\Requests;
use Oansa\Http\Controllers\Controller;

class LiderController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');
        //$this->middleware('admin');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }
    public function find(Route $route){
        $this->lider = Lider::find($route->getParameter('lider'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lideres = Lider::All();
        return view('lider.index',compact('lideres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre=$request['nombre'];
        $apellido=$request['apellido'];
        $fechaNacimiento=$request['fechaNacimiento'];
        $sexo=$request['sexo']; 
        $direccion=$request['direccion'];
        $telefono=$request['telefono'];
        $idArea=$request['idArea'];
        $liderGdc=$request['liderGdc'];
        $telefonoLiderGdc=$request['telefonoLiderGdc'];
        $iglesia=$request['iglesia'];
        Lider::create([
            'nombre'=>$nombre,
            'apellido'=>$apellido,
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
        //
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
}