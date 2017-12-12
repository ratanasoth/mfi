<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ZoneController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['zones'] = DB::table('zones')->where('active',1)->paginate(12);
        return view('zones.index', $data);
    }
}
