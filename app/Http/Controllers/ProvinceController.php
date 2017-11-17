<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['provinces'] = DB::table("provinces")
            ->where("active",1)
            ->orderBy('name')
            ->paginate(12);
        return view("provinces.index", $data);
    }
    // create
    public function create()
    {
        return view("provinces.create");
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("provinces")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New province has been created successfully!");
            return redirect("/province/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new province!");
            return redirect("/province/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['province'] = DB::table("provinces")->where("id", $id)->first();
        return view("provinces.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("provinces")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/province/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/province/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("provinces")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/province?page='.$page);
        }
        return redirect('/province');
    }
    
}
