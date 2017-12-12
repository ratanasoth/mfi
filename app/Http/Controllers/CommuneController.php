<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CommuneController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['communes'] = DB::table("communes")
            ->join("districts", "communes.district_id","=", "districts.id")
            ->join("provinces", "districts.province_id","=", "provinces.id")
            ->where("communes.active",1)
            ->orderBy('communes.name')
            ->select("communes.*", "provinces.name as pname", "districts.name as dname")
            ->paginate(12);
        return view("communes.index", $data);
    }
    // create
    public function create()
    {
        $data["provinces"] = DB::table("provinces")->where("active",1)->orderBy("name")->get();
        return view("communes.create", $data);
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
     public function edit($id)
     {
         $data['commune'] = DB::table('communes')->where('id', $id)->first();
         $data['provinces'] = DB::table('provinces')->where('active',1)->get();
         $data['districts'] = DB::table('districts')->where('active',1)->where('province_id', $data['commune']->province_id)->get();
         return view('communes.edit', $data);
     }
     public function update(Request $r)
     {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "province_id" => $r->province_id,
            "district_id" => $r->district_id
        );
        $i = DB::table('communes')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/commune/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save change!');
            return redirect('/commune/edit/'.$r->id);
        }
     }
     public function delete($id)
     {
         $i = DB::table("communes")->where("id", $id)->update(["active"=>0]);
         $page = @$_GET['page'];
         if ($page>0)
         {
             return redirect('/commune?page='.$page);
         }
         return redirect('/commune');
     }
     public function get($id)
     {
         return DB::table('communes')->where('district_id', $id)->get();
     }
}
