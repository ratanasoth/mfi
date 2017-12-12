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
             'commune_id' => $r->commune_id,
             "province_id" => $r->province_id,
             "district_id" => $r->district_id
         );
         $i = DB::table("villages")->insert($data);
         if($i)
         {
             $r->session()->flash("sms", "New village has been created successfully!");
             return redirect("/village/create");
         }
         else{
             $r->session()->flash("sms1", "Fail to create new village!");
             return redirect("/village/create")->withInput();
         }
     }
     public function edit($id)
     {
        $data["provinces"] = DB::table("provinces")->where("active",1)->orderBy("name")->get();
        $data['village'] = DB::table('villages')->where('id', $id)->first();
        $data['districts'] = DB::table('districts')->where('active', 1)->where('province_id', $data['village']->province_id)->get();
        $data['communes'] = DB::table('communes')->where('active', 1)->where('district_id', $data['village']->district_id)->get();
        return view('villages.edit', $data);        
     }
     public function update(Request $r)
     {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            'commune_id' => $r->commune_id,
            "province_id" => $r->province_id,
            "district_id" => $r->district_id
        );
        $i = DB::table('villages')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/village/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save change!');
            return redirect('/village/edit/'.$r->id);
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
