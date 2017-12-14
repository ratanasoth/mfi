<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

class LoanProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['loan_products'] = DB::table('loan_products')->where('active',1)->orderBy('id', 'asc')->paginate(12);
        return view('loan-products.index', $data);
    }
    public function create()
    {
        return view('loan-products.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('loan_products')->insert($data);
        if($i)
        {   
            $r->session()->flash('sms', "New loan product has been created successfully!");
            return redirect('/loan-product/create');
        }
        else{

            $r->session()->flash('sms1', "Fail to create new loan product!");
            return redirect('/loan-product/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['loan_product'] = DB::table('loan_products')->where('id', $id)->first();
        return view('loan-products.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('loan_products')->where('id', $r->id)->update($data);
        if($i)
        {   
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/loan-product/edit/'. $r->id);
        }
        else{

            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/loan-product/edit/'. $r->id);            
        }
    }
    public function delete($id)
    {
        $i = DB::table("loan_products")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/loan-product?page='.$page);
        }
        return redirect('/loan-product');
    }
}
