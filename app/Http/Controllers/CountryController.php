<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['countries'] = DB::table("countries")
            ->where("active",1)
            ->orderBy('name')
            ->paginate(12);
        return view("countries.index", $data);
    }
    // create
    public function create()
    {
        return view("countries.create");
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("countries")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New country has been created successfully!");
            return redirect("/country/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new country!");
            return redirect("/country/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['country'] = DB::table("countries")->where("id", $id)->first();
        return view("countries.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("countries")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/country/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/country/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("countries")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/country?page='.$page);
        }
        return redirect('/country');
    }
}
