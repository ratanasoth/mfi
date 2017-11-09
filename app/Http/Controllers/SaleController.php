<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class SaleController extends Controller
{
    // index function
    public function index()
    {
        return view("sales.index");
    }
}
