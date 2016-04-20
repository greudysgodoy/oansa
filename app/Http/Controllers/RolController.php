<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;

use Oansa\Rol;
use Oansa\Http\Requests\RolRequest;
use Oansa\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Session;
use Redirect;
use Auth;

class RolController extends Controller
{
     public function __construct(){
        //$this->middleware('auth');
        //$this->middleware('admin');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }

    public function find(Route $route){
        $this->rol = Rol::find($route->getParameter('rol'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::All();
        return view('rol.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        $nombre=$request['nombre'];
        $descripcion=$request['descripcion'];
        Rol::create([
            'nombre'=>$nombre,
            'descripcion'=>$descripcion,
            'estatus' => '1',
            ]);
        Session::flash('message-success','Rol registrado exitosamente');
        return Redirect::to('/rol');
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
        return view('rol.edit',['rol'=>$this->rol]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        $this->rol->fill($request->all());
        $this->rol->save();
        Session::flash('message-success','Rol Actualizada Correctamente');
        return Redirect::to('/rol');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->rol->delete();
        Session::flash('message-success','Rol Eliminado Correctamente');
        return Redirect::to('/rol');
    }
}
