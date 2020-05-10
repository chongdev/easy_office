<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()) {
            $data = DB::table('letter')
        ->select("*","letter.id as id","users.name as username","department.name as departmentname","position.name as positionname",)
        ->leftjoin('users',"users.id","=","letter.U_id")
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position")
        ->where('status',"=",'รออนุมัดติ')
        ->get();
        return view('admin/dashboard')->with( ["data"=>$data] );
        } else {
            return view('user/mainuser');
        }
    }
    
}
