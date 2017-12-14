<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class LoanSizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['loan_sizes'] = DB::table('loan_sizes')->where('active',1)->orderBy('id', 'desc')->paginate(12);
        return view('loan-sizes.index', $data);
    }
    public function create()
    {
        return view('loan-sizes.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('loan_sizes')->insert($data);
        if($i)
        {   
            $r->session()->flash('sms', "New loan size has been created successfully!");
            return redirect('/loan-size/create');
        }
        else{

            $r->session()->flash('sms1', "Fail to create new loan size!");
            return redirect('/loan-size/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['loan_size'] = DB::table('loan_sizes')->where('id', $id)->first();
        return view('loan-sizes.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('loan_sizes')->where('id', $r->id)->update($data);
        if($i)
        {   
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/loan-size/edit/'. $r->id);
        }
        else{

            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/loan-size/edit/'. $r->id);            
        }
    }
    public function delete($id)
    {
        $i = DB::table("loan_sizes")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/loan-size?page='.$page);
        }
        return redirect('/loan-size');
    }
}
