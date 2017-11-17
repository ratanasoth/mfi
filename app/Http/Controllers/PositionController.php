<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['positions'] = DB::table("positions")
            ->where("active",1)
            ->orderBy("name")
            ->paginate(12);
        return view("positions.index", $data);
    }
    // create
    public function create()
    {
        return view("positions.create");
    }
     // save
     public function save(Request $r)
     {
         $data = array(
             "code" => $r->code,
             "name" => $r->name
         );
         $i = DB::table("positions")->insert($data);
         if($i)
         {
             $r->session()->flash("sms", "New position has been created successfully!");
             return redirect("/position/create");
         }
         else{
             $r->session()->flash("sms1", "Fail to create new position!");
             return redirect("/position/create")->withInput();
         }
     }
     // edit
     public function edit($id)
     {
         $data['position'] = DB::table("positions")->where("id", $id)->first();
         return view("positions.edit", $data);
     }
     // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("positions")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/position/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/position/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("positions")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/position?page='.$page);
        }
        return redirect('/position');
    }
}
