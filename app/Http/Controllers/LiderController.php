<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;

use Oansa\Http\Requests\LiderRequest;
use Oansa\Lider;
use Oansa\Area;
use Oansa\Rol;
use DB;
use Oansa\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Session;
use Redirect;

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
        $lideres = DB::table('lideres')
            ->join('areas','lideres.area_Id','=','areas.id')
            ->join('roles','lideres.rol_Id','=','roles.id')
            ->select('lideres.*','areas.nombre AS nombreArea','roles.nombre AS nombreRol')
            ->get();
        return view('lider.index',compact('lideres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::lists('nombre','id');
        $roles = Rol::lists('nombre','id');
        return view('lider.create',compact('areas','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LiderRequest $request)
    {
        $cedula=$request['cedula'];
        $nombre=$request['nombre'];
        $apellido=$request['apellido'];
        $fechaNacimiento=$request['fechaNacimiento'];
        $sexo=$request['sexo']; 
        $telefono=$request['telefono'];
        $email=$request['email'];
        $area_Id=$request['area_Id'];
        $rol_Id = $request['rol_Id'];
        $liderGdc=$request['liderGdc'];
        $telefonoLiderGdc=$request['telefonoLiderGdc'];
        $password=$request['password'];
        Lider::create([
            'cedula'=>$cedula,
            'nombre'=>$nombre,
            'apellido'=>$apellido,
            'fechaNacimiento'=>$fechaNacimiento,
            'sexo'=>$sexo,
            'telefono'=>$telefono,
            'email'=>$email,
            'password'=>$password,
            'liderGdc'=>$liderGdc,
            'telefonoLiderGdc'=>$telefonoLiderGdc,
            'area_Id'=>$area_Id,
            'rol_Id' =>$rol_Id,
            'estatus' => '1',
            ]);
        Session::flash('message-success','Lider registrado exitosamente');
        return Redirect::to('/lider');
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
        $areas = Area::lists('nombre','id');
        $roles = Rol::lists('nombre','id');
        return view('lider.edit',['lider'=>$this->lider],compact('areas','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LiderRequest $request, $id)
    {
        $this->oansista->fill($request->all());
        $this->oansista->save();
        Session::flash('message-success','Lider Actualizado Correctamente');
        return Redirect::to('/lider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->lider->delete();
        Session::flash('message-success','Lider Eliminado Correctamente');
        return Redirect::to('/lider');
    }
}
