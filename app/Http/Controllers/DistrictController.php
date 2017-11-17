<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['districts'] = DB::table("districts")
            ->join("provinces", "districts.province_id","=", "provinces.id")
            ->where("districts.active",1)
            ->orderBy('districts.name')
            ->select("districts.*", "provinces.name as pname")
            ->paginate(12);
        return view("districts.index", $data);
    }
    // create
    public function create()
    {
        $data["provinces"] = DB::table("provinces")->where("active",1)->orderBy("name")->get();
        return view("districts.create", $data);
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "province_id" => $r->province_id
        );
        $i = DB::table("districts")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New district has been created successfully!");
            return redirect("/district/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new district!");
            return redirect("/district/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['district'] = DB::table("districts")->where("id", $id)->first();
        $data["provinces"] = DB::table("provinces")->where("active",1)->orderBy("name")->get();
        return view("districts.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "province_id" => $r->province_id
        );
        $i = DB::table("districts")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/district/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/district/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("districts")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/district?page='.$page);
        }
        return redirect('/district');
    }
    // get district by province
    public function get($id)
    {
        return DB::table('districts')->where("province_id",$id)->where("active",1)->orderBy("name")->get();
    }
}
