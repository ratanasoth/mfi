<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ZoneController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['zones'] = DB::table('zones')->where('active',1)->orderBy('id', 'desc')->paginate(12);
        return view('zones.index', $data);
    }
    public function create()
    {
        return view('zones.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'area_name' => $r->area_name,
            'interest_rate' => $r->interest_rate,
            'client_limit' => $r->client_limit,
            'contact_name' => $r->contact_name
        );
        $i = DB::table('zones')->insert($data);
        if($i)
        {   
            $r->session()->flash('sms', "New zone has been created successfully!");
            return redirect('/zone/create');
        }
        else{

            $r->session()->flash('sms1', "Fail to create new zone!");
            return redirect('/zone/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['zone'] = DB::table('zones')->where('id', $id)->first();
        return view('zones.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'area_name' => $r->area_name,
            'interest_rate' => $r->interest_rate,
            'client_limit' => $r->client_limit,
            'contact_name' => $r->contact_name
        );
        $i = DB::table('zones')->where('id', $r->id)->update($data);
        if($i)
        {   
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/zone/edit/'. $r->id);
        }
        else{

            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/zone/edit/'. $r->id);            
        }
    }
    public function delete($id)
    {
        $i = DB::table("zones")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/zone?page='.$page);
        }
        return redirect('/zone');
    }
}
