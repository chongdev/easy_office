<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\leavemodel AS GU;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cValidator = [
        'status' => 'required',
      
      ];
    
      protected $cValidatorMsg = [
        'status.required' => 'กรุณาเลือกการอนุมัดติ',
     
      ];
    public function index()
    {
        //
        $data = DB::table('letter')
        ->select("*","letter.id as id","users.name as username","department.name as departmentname","position.name as positionname",)
        ->leftjoin('users',"users.id","=","letter.U_id")
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position")
        ->where('status',"=",'รออนุมัดติ')
        ->get();
        return view('admin/dashboard')->with( ["data"=>$data] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/forms.formadduser')->with(['department'=>DM::get() ,'position'=>PM::get() ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = GU::findOrFail( $id );
      if( is_null($data) ){
        return back()->with('jsAlert', "ไม่พบข้อมูลที่ต้องการแก้ไข");
    }
    $data = DB::table('letter')
        ->select("*","letter.id as id","users.name as username","department.name as departmentname","position.name as positionname","letter.image as photo",)
        ->leftjoin('users',"users.id","=","letter.U_id")
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position")
        ->where('letter.id',"=",$id)
        ->get();
    return view('admin/forms.formapprove')->with(['data'=>$data]);
    }
    public function delete($id)
    {
        //
        $data = GU::findOrFail($id);
      if( is_null($data) ){
        return back()->with('jsAlert', "ไม่พบข้อมูลที่ต้องการแก้ไข");
    }
    if(!empty($data->profile) ){
      storage::disk('public')->delete( $data->profile );
    }
    $data->delete();
    return back()->with('jsAlert', "ลบข้อมูลสำเร็จ");
  }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make( $request->all(), $this->cValidator, $this->cValidatorMsg);
      if( $validator->fails() ){
            return back()->withInput()->withErrors( $validator->errors() );
        }
        else{
      $data = GU::findOrFail( $id );
      if( is_null($data) ){
        return back()->with('jsAlert', "ไม่พบข้อมูลที่ต้องการแก้ไข");
            }
            $data->fill([
              "approve" =>$request->approve,
              "status" =>$request->status,
            ]);
              $data->update();
        }
              return redirect()->to('admin\dashboard')->with('jsAlert', 'ข้อมูลสำเร็จ');     
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function destroy($id)
    {
        //
        
    }
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    
}
