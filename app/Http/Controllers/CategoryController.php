<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index(Request $r)
    {
        $data['categories'] = DB::table("categories as a")
            ->leftJoin("categories as b", "a.parent_id", "b.id")
            ->where("a.active", 1)
            ->where("a.company_id", Auth::user()->company_id)
            ->orderBy("a.name")
            ->select("a.*", "b.name as parent_name")
            ->paginate(12);
        return view("categories.index", $data);
    }
    public function create(Request $r)
    {

        $data['categories'] = DB::table("categories")
            ->where("active", 1)
            ->where("company_id", Auth::user()->company_id)
            ->orderBy("name")
            ->get();
        return view("categories.create", $data);
    }
    public function save(Request $r)
    {

        $data = array(
            "name" => $r->name,
            "parent_id" => $r->parent,
            "create_by" => Auth::user()->id,
            "company_id" => Auth::user()->company_id
        );
        $i = DB::table("categories")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New category has been created successfully!");
            return redirect("/category/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new category!");
            return redirect("/category/create");
        }
    }
    public function edit($id)
    {
        $data['categories'] = DB::table("categories")
            ->where("active", 1)
            ->where("company_id", Auth::user()->company_id)
            ->orderBy("name")
            ->get();
        $data['category'] = DB::table("categories")->where("id", $id)->first();
        return view("categories.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "parent_id" => $r->parent
        );
        $i = DB::table("categories")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/category/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/category/edit/". $r->id);
        }
    }
    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/category?page='.$page);
        }
        return redirect('/category');
    }
}
