<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class POSController extends Controller
{
    // index
    public function index()
    {
        return view('poss.index');
    }
}
