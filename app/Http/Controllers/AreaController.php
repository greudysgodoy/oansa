<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;
use Oansa\Area;
use Oansa\Http\Requests;
use Oansa\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Session;
use Redirect;
use Auth;

class AreaController extends Controller
{

    public function __construct(){
        //$this->middleware('auth');
        //$this->middleware('admin');
        $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }

    public function find(Route $route){
        $this->area = Area::find($route->getParameter('area'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::All();
        return view('area.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('area.create');
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
        $descripcion=$request['descripcion'];
        Area::create([
            'nombre'=>$nombre,
            'descripcion'=>$descripcion,
            'estatus' => '1',
            ]);
        Session::flash('message-success','Área registrada exitosamente');
        return Redirect::to('/area');
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
        return view('area.edit',['area'=>$this->area]);
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
        $this->area->fill($request->all());
        $this->area->save();
        Session::flash('message-success','Área Actualizada Correctamente');
        return Redirect::to('/area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->area->delete();
        Session::flash('message-success','Área Eliminado Correctamente');
        return Redirect::to('/area');
    }
}
