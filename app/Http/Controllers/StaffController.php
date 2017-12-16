<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['staffs'] = DB::table('staffs')->where('active',1)->orderBy('id', 'desc')->paginate(12);
        return view('staffs.index', $data);
    }
    public function create()
    {
        $data['positions'] = DB::table('positions')->where('active',1)->orderBy('name', 'asc')->get();
        $data['supervisors'] = DB::table('staffs')->where('active',1)->orderBy('last_name', 'asc')->get();
        $data['departments'] = DB::table('departments')->where('active',1)->orderBy('name', 'asc')->get();
        $data['loan_sizes'] = DB::table('loan_sizes')->where('active',1)->orderBy('name', 'asc')->get();
        return view('staffs.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'khmer_name' => $r->khmer_name,
            'staff_code' => $r->staff_code,
            'position_id' => $r->position,
            'supervisor_id' => $r->supervisor,
            'department_id' => $r->department,
            'address' => $r->address,
            'dob' => $r->dob,
            'start_date' => $r->start_date,
            'stop_date' => $r->stop_date,
            'loan_size' => $r->loan_size,
            'phone' => $r->phone,
            'email' => $r->email,
        );
        $i = DB::table('staffs')->insertGetId($data);
        if($i)
        {   
            // upload file
           
            $file = $r->file('photo');
            if($file !== null){
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/profiles/';
                $file->move($destinationPath, $file_name);
                $data = array(
                    'photo' => $file_name
                );
                DB::table('staffs')->where('id', $i)->update($data);
            }
            $r->session()->flash('sms', "New staff has been created successfully!");
            return redirect('/staff/create');
        }
        else{

            $r->session()->flash('sms1', "Fail to create new staff!");
            return redirect('/staff/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['positions'] = DB::table('positions')->where('active',1)->orderBy('name', 'asc')->get();
        $data['supervisors'] = DB::table('staffs')->where('active',1)->orderBy('last_name', 'asc')->get();
        $data['departments'] = DB::table('departments')->where('active',1)->orderBy('name', 'asc')->get();
        $data['loan_sizes'] = DB::table('loan_sizes')->where('active',1)->orderBy('name', 'asc')->get();
        $data['staff'] = DB::table('staffs')
            ->join('departments', 'departments.id', '=', 'staffs.department_id')
            ->join('positions', 'positions.id' , '=', 'staffs.position_id')
            ->join('staffs as supervisors', 'supervisors.id' , '=', 'staffs.supervisor_id')
            ->join('loan_sizes', 'loan_sizes.id' , '=', 'staffs.loan_size')
            ->select('staffs.*', 
                'positions.id as pos_id', 
                'loan_sizes.name as loan_size', 
                'positions.name as position', 
                'departments.id as dep_id',
                'supervisors.id as sup_id',
                'loan_sizes.id as loa_id',
                'staffs.id as id', 
                'departments.name as department')
            ->where('staffs.active', 1)
            ->where('staffs.id', $id)
            ->first();
        return view('staffs.edit', $data);
    }
    public function detail($id)
    {
        $data['staff'] = DB::table('staffs')
            ->join('departments', 'departments.id', '=', 'staffs.department_id')
            ->join('positions', 'positions.id' , '=', 'staffs.position_id')
            ->join('loan_sizes', 'loan_sizes.id' , '=', 'staffs.loan_size')
            ->join('staffs as supervisors', 'supervisors.id' , '=', 'staffs.supervisor_id')
            ->select('staffs.*','loan_sizes.name as loan_size', 'supervisors.first_name as s_firstname', 'supervisors.last_name as s_lastname', 'positions.name as position', 'staffs.id as id', 'departments.name as department')
            ->where('staffs.active', 1)
            ->where('staffs.id', $id)
            ->first();
        return view('staffs.detail', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'khmer_name' => $r->khmer_name,
            'staff_code' => $r->staff_code,
            'position_id' => $r->position,
            'supervisor_id' => $r->supervisor,
            'department_id' => $r->department,
            'address' => $r->address,
            'dob' => $r->dob,
            'start_date' => $r->start_date,
            'stop_date' => $r->stop_date,
            'loan_size' => $r->loan_size,
            'phone' => $r->phone,
            'email' => $r->email,
        );
        $file = $r->file('photo');
        if($file !== null){
            $file_name = $r->id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/profiles/';
            $file->move($destinationPath, $file_name);
            $data = array(
                'photo' => $file_name
            );
        }
        $i = DB::table('staffs')->where('id', $r->id)->update($data);
        if($i)
        {   
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/staff/edit/'. $r->id);
        }
        else{

            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/staff/edit/'. $r->id);            
        }
    }
    public function delete($id)
    {
        $i = DB::table("staffs")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/staffs?page='.$page);
        }
        return redirect('/staff');
    }
}
