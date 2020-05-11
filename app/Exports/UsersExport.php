<?php

namespace App\Exports;
use App\Models\AdminModel AS GU;
use DB;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       
        return  $data = DB::table('letter')
        ->select("users.id" ,"users.prefix","users.name","lastname" , "position.name AS position" , 
        "department.name as department", "letter.vacation_Name" ,"letter.since" ,"letter.todate", "letter.alltime",)
        ->leftjoin('users',"users.id","=","letter.U_id")
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position")
        ->where('letter.status',"=","อนุมัดติการลา")
        ->get();
    }
    
}
