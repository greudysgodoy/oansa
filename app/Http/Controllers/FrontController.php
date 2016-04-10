<?php

namespace Oansa\Http\Controllers;

use Illuminate\Http\Request;

use Oansa\Http\Requests;
use Oansa\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function admin(){
        return view('admin.index');
    }

}