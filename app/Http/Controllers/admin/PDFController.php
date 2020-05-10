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
     return view('admin\export_pdf')->with('customer_data', $customer_data);
    }

    function get_customer_data()
    {
     $customer_data = DB::table('letter')
     ->select("users.id as userid" ,"users.prefix","users.name as username","lastname" , "position.name AS position" , 
     "department.name as department", "letter.vacation_Name" ,"letter.since" ,"letter.todate", "letter.alltime",)
     ->leftjoin('users',"users.id","=","letter.U_id")
     ->leftjoin('department',"department.id","=","users.department")
     ->leftjoin('position',"position.id","=","users.position")
     ->limit(10)
     ->get();
     return $customer_data;
    }

    function pdf()
    {
     $customer_data = GU::all();
     $pdf = PDF::loadView('pdf',['customer_data'=>$customer_data]);
     return $pdf->stream();
    }

    function convert_customer_data_to_html()
    {
     $customer_data = $this->get_customer_data();
     $output = '
     <h3 align="center">Customer Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">No</th>
    <th style="border: 1px solid; padding:12px;" width="30%">รหัสมาชิก</th>
    <th style="border: 1px solid; padding:12px;" width="15%">ชื่อสมาชิก</th>
    <th style="border: 1px solid; padding:12px;" width="15%">ตำแหน่ง</th>
    <th style="border: 1px solid; padding:12px;" width="20%">ฝ่าย/แผนก</th>
    <th style="border: 1px solid; padding:12px;" width="20%">หมายเหตุการลา</th>
    <th style="border: 1px solid; padding:12px;" width="20%">วันที่ลา</th>
    <th style="border: 1px solid; padding:12px;" width="20%">ถึงวันที่</th>
    <th style="border: 1px solid; padding:12px;" width="20%">รวม</th>
   </tr>
     ';  
     $num=1;
     foreach($customer_data as $customer)
     {
         
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$num.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->prefix."".$customer->username."".$customer->lastname.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->position.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->department.'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->vacation_Name.'</td>
       <td style="border: 1px solid; padding:12px;">'.date('d-M-Y', strtotime($customer->since)).'</td>
       <td style="border: 1px solid; padding:12px;">'.date('d-M-Y', strtotime($customer->todate)) .'</td>
       <td style="border: 1px solid; padding:12px;">'.$customer->alltime.'</td>
      </tr>
      ';
      $num++;
     }
     $output .= '</table>';
     return $output;
    }
}
