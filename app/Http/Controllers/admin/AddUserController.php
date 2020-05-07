<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AdminModel AS GU;
use App\Models\departmentModel AS DM;
use App\Models\positionModel AS PM;
use DB;

class AddUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cValidator = [
        'name' => 'required|min:3|max:255',
        'lastname' => 'required|min:3|max:255',
        'prefix' => 'required|min:2',
        'password' => 'required|min:5',
      ];
    
      protected $cValidatorMsg = [
        'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
        'name.required' => 'กรุณากรอกชื่อ',
        'name.min' => 'ชื่อสินค้าต้องมีอย่างน้อย 3 ตัวอักษร',
        'name.max' => 'ชื่อสินค้าต้องมีไม่เกิน 255 ตัวอักษร',
        'lastname.required' => 'กรุณากรอกนามสกุล',
        'lastname.min' => 'นามสกุลต้องมีอย่างน้อย 3 ตัวอักษร',
        'lastname.max' => 'นามสกุลต้องมีไม่เกิน 255 ตัวอักษร',
        'password.required' => 'กรุณากรอกรหัสผ่าน',
        'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 5 ตัวอักษร'
      ];
    public function index()
    {
        //
        $data = DB::table('users')
        ->select("*","users.name as username","department.name as departmentname","position.name as positionname")
        ->join('department',"department.id","=","users.department")
        ->join('position',"position.id","=","users.position")
        ->get()
        ;

        return view('admin/manageuser')->with( ["data"=>$data] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('form.formProduct')->with([ 'type'=>PTM::get() ,'store'=>ST::get() ]);
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
}
