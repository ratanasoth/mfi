<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class PaymentMoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['payment_moods'] = DB::table('payment_moods')->where('active',1)->orderBy('name')->paginate(12);
        return view('payment-moods.index', $data);
    }
    public function create()
    {
        return view('payment-moods.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('payment_moods')->insert($data);
        if($i)
        {   
            $r->session()->flash('sms', "New payment mood has been created successfully!");
            return redirect('/payment-mood/create');
        }
        else{

            $r->session()->flash('sms1', "Fail to create new payment mood!");
            return redirect('/payment-mood/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['payment_mood'] = DB::table('payment_moods')->where('id', $id)->first();
        return view('payment-moods.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('payment_moods')->where('id', $r->id)->update($data);
        if($i)
        {   
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/payment-mood/edit/'. $r->id);
        }
        else{

            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/payment-mood/edit/'. $r->id);            
        }
    }
    public function delete($id)
    {
        $i = DB::table("payment_moods")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/payment-mood?page='.$page);
        }
        return redirect('/payment-mood');
    }
}
