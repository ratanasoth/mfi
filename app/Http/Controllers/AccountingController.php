<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class AccountingController extends Controller
{
    // index
    public function index()
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        return view('accountings.index');
    }
}
