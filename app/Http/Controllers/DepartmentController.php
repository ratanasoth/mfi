<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['departments'] = DB::table("departments")
            ->where("active",1)
            ->orderBy("name")
            ->paginate(12);
        return view("departments.index", $data);
    }
    // create
    public function create()
    {
        return view("departments.create");
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("departments")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New department has been created successfully!");
            return redirect("/department/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new department!");
            return redirect("/department/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['department'] = DB::table("departments")->where("id", $id)->first();
        return view("departments.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name
        );
        $i = DB::table("departments")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/department/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/department/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("departments")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/department?page='.$page);
        }
        return redirect('/department');
    }
}
