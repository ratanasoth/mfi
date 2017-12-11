<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class VillageController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['villages'] = DB::table("villages")
            ->join("communes","villages.commune_id","=", "communes.id")
            ->join("districts", "communes.district_id","=", "districts.id")
            ->join("provinces", "districts.province_id","=", "provinces.id")
            ->where("villages.active",1)
            ->orderBy('villages.name')
            ->select("villages.*", "provinces.name as pname", "districts.name as dname","communes.name as cname")
            ->paginate(12);
        return view("villages.index", $data);
    }
    // create
    public function create()
    {
        $data["provinces"] = DB::table("provinces")->where("active",1)->orderBy("name")->get();
        return view("villages.create", $data);
    }
     // save
     public function save(Request $r)
     {
         $data = array(
             "code" => $r->code,
             "name" => $r->name,
             "province_id" => $r->province_id,
             "district_id" => $r->district_id
         );
         $i = DB::table("communes")->insert($data);
         if($i)
         {
             $r->session()->flash("sms", "New commune has been created successfully!");
             return redirect("/commune/create");
         }
         else{
             $r->session()->flash("sms1", "Fail to create new commune!");
             return redirect("/commune/create")->withInput();
         }
     }
     public function delete($id)
     {
         $i = DB::table("villages")->where("id", $id)->update(["active"=>0]);
         $page = @$_GET['page'];
         if ($page>0)
         {
             return redirect('/village?page='.$page);
         }
         return redirect('/village');
     }
}
