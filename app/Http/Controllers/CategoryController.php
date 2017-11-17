<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $data['categories'] = DB::table("categories")
            ->where("active",1)
            ->orderBy("code")
            ->paginate(12);
        return view("categories.index", $data);
    }
    // create
    public function create()
    {
        return view("categories.create");
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "description" => $r->description,
            "khmer_description" => $r->khmer_description
        );
        $i = DB::table("categories")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New category has been created successfully!");
            return redirect("/category/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new category!");
            return redirect("/category/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['category'] = DB::table("categories")->where("id", $id)->first();
        return view("categories.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "description" => $r->description,
            "khmer_description" => $r->khmer_description
        );
        $i = DB::table("categories")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/category/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
            return redirect("/category/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("categories")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/category?page='.$page);
        }
        return redirect('/category');
    }
    //
}
