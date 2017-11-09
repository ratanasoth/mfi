<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class UnitController extends Controller
{
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
    public function index(Request $r)
    {
        $data['units'] = DB::table("units")
            ->where("active", 1)
            ->where("company_id", Auth::user()->company_id)
            ->orderBy("name")
            ->paginate(12);
        return view("units.index", $data);
    }
    public function create()
    {
        return view("units.create");
    }
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "create_by" => Auth::user()->id,
            "company_id" => Auth::user()->company_id
        );
        $i = DB::table("units")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New unit has been created successfully!");
            return redirect("/unit/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new unit!");
            return redirect("/unit/create")->withInput();
        }
    }
    public function edit($id)
    {
        $data['unit'] = DB::table("units")->where("id", $id)->first();
        return view("units.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("units")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/unit/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/unit/edit/".$r->id);
        }
    }
    //
}
