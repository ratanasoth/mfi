<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class ProvisionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['provisions'] = DB::table("provisions")
            ->where("active",1)
            ->paginate(12);
        return view("provisions.index", $data);
    }
    // create
    public function create()
    {
        return view("provisions.create");
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "description" => $r->description,
            "length_of_day" => $r->length_of_day,
            "term" => $r->term,
            "provision_percentage" => $r->provision_percentage
        );
        $i = DB::table("provisions")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New provision has been created successfully!");
            return redirect("/provision/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new provision!");
            return redirect("/provision/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['provision'] = DB::table("provisions")->where("id", $id)->first();
        return view("provisions.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "description" => $r->description,
            "length_of_day" => $r->length_of_day,
            "term" => $r->term,
            "provision_percentage" => $r->provision_percentage
        );
        $i = DB::table("provisions")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/provision/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/provision/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("provisions")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/provision?page='.$page);
        }
        return redirect('/provision');
    }
}
