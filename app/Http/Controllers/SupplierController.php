<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SupplierController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }

    public function index(Request $r){
    	 $data['suppliers'] = DB::table("suppliers")
            ->where("active", 1)
            ->where("company_id", Auth::user()->company_id)
            ->orderBy("name")
            ->paginate(12);
    	return view('supplier.index' , $data);
    }

    public function create(Request $r){
    	return view('supplier.create');
    }

    public function save(Request $r){
    	$data = array(
            "name" => $r->name,
            "phone" => $r->phone,
            "email" => $r->email,
            "address" => $r->address,
            "create_by" => Auth::user()->id,
            "company_id" => Auth::user()->company_id
        );
        $i = DB::table("suppliers")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New Supplier has been created successfully!");
            return redirect("/supplier/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new supplier!");
            return redirect("/supplier/create");
        }
    }

    public function edit($id)
    {
        
        $data['supplier'] = DB::table("suppliers")->where("id", $id)->first();
        return view("supplier.edit", $data);
    }

    public function update(Request $r){
    	$data = array(
            "name" => $r->name,
            "phone" => $r->phone,
            "email" => $r->email,
            "address" => $r->address
        );
        $i = DB::table("suppliers")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/supplier/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/supplier/edit/". $r->id);
        }
    }

    public function delete($id)
    {
        DB::table('suppliers')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/supplier?page='.$page);
        }
        return redirect('/supplier');
    }
}
