<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    // index
    public function index()
    {
        return view("parameters.index");
    }
}
