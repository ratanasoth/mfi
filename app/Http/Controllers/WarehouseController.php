<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class WarehouseController extends Controller
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
    	 $data['warehouses'] = DB::table("warehouses")
            ->where("active", 1)
            ->where("company_id", Auth::user()->company_id)
            ->orderBy("name")
            ->paginate(12);
    	return view('warehouse.index' , $data);
    }

    public function create(Request $r) {
    	return view('warehouse.create');
    }
    public function save(Request $r){
    	$data = array(
            "name" => $r->name,
            "address" => $r->address,
            "create_by" => Auth::user()->id,
            "company_id" => Auth::user()->company_id
        );
        $i = DB::table("warehouses")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New warehouse has been created successfully!");
            return redirect("/warehouse/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new warehouse!");
            return redirect("/warehouse/create");
        }
    }

    public function edit($id)
    {
        
        $data['warehouse'] = DB::table("warehouses")->where("id", $id)->first();
        return view("warehouse.edit", $data);
    }

    public function update(Request $r){
    	$data = array(
            "name" => $r->name,
            "address" => $r->address
        );
        $i = DB::table("warehouses")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/warehouse/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/warehouse/edit/". $r->id);
        }
    }

    public function delete($id)
    {
        DB::table('warehouses')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/warehouse?page='.$page);
        }
        return redirect('/warehouse');
    }
}
