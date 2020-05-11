<?php

namespace App\Http\Controllers\admin;
use PDF;
use DB;
use App\Models\leavemodel AS GU;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{
    function index()
    {
     $customer_data = $this->get_customer_data();
     return view('admin\export')->with('customer_data', $customer_data);
    }

    function get_customer_data()
    {
     $customer_data = DB::table('letter')
     ->select("users.id as userid" ,"users.prefix","users.name as username","lastname" , "position.name AS position" , 
     "department.name as department", "letter.vacation_Name" ,"letter.since" ,"letter.todate", "letter.alltime",)
     ->leftjoin('users',"users.id","=","letter.U_id")
     ->leftjoin('department',"department.id","=","users.department")
     ->leftjoin('position',"position.id","=","users.position")
     ->where('letter.status',"=","อนุมัดติการลา")
     ->get();
     return $customer_data;
    }

    function pdf()
    {
     $customer_data = DB::table('letter')
     ->select("users.id as userid" ,"users.prefix","users.name as username","lastname" , "position.name AS position" , 
     "department.name as department", "letter.vacation_Name" ,"letter.since" ,"letter.todate", "letter.alltime",)
     ->leftjoin('users',"users.id","=","letter.U_id")
     ->leftjoin('department',"department.id","=","users.department")
     ->leftjoin('position',"position.id","=","users.position")
     ->where('letter.status',"=","อนุมัดติการลา")
     ->get();
     $pdf = PDF::loadView('pdf',['customer_data'=>$customer_data]);
     return @$pdf->stream();
    }

}
