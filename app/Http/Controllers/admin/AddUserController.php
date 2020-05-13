<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\AdminModel AS GU;
use App\Models\userModel AS UM;
use App\Models\departmentModel AS DM;
use App\Models\positionModel AS PM;
use Illuminate\Support\Facades\Storage;
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
        'position' => 'required',
        'department' => 'required',
        'password' => 'required|min:5',
      ];
    
      protected $cValidatorMsg = [
        'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
        'name.required' => 'กรุณากรอกชื่อ',
        'name.min' => 'ชื่อต้องมีอย่างน้อย 3 ตัวอักษร',
        'name.max' => 'ชื่อต้องมีไม่เกิน 255 ตัวอักษร',
        'lastname.required' => 'กรุณากรอกนามสกุล',
        'lastname.min' => 'นามสกุลต้องมีอย่างน้อย 3 ตัวอักษร',
        'lastname.max' => 'นามสกุลต้องมีไม่เกิน 255 ตัวอักษร',
        'position.required' => 'กรุณาเลือกตำแหน่งงาน',
        'department.required' => 'กรุณาเลือกฝ่าย /แผนก',
        'password.required' => 'กรุณากรอกรหัสผ่าน',
        'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 5 ตัวอักษร'
      ];
    public function index()
    {
        //
        $data = DB::table('users')
        ->select("*","users.id as id","users.name as username","department.name as departmentname","position.name as positionname",)
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position")
        ->get();
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
        $validator = Validator::make( $request->all(), $this->cValidator, $this->cValidatorMsg);
        if( $validator->fails() ){
            return back()->withInput()->withErrors( $validator->errors() );
          }
          else{
          $data = new UM;
          $data->fill([
            "name" =>$request->name,
            "email" =>$request->email,
            "password" => Hash::make($request->password),
            "lastname" =>$request->lastname,
            "position" =>$request->position,
            "department"=>$request->department,
            "prefix" =>$request->prefix,
            "type"=>0,
          ]);
          if($data->save()){
            if($request->has('profile') ){
              $data->profile = $request->file('profile')->store('profile','public');
              $data->update();
            }
          }
          return redirect()->route('manageuser.index')->with('jsAlert', 'เพิ่มข้อมูลสำเร็จ');
        }
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
    
    return view('admin/forms.formadduser')->with(['data'=>$data,'department'=>DM::get() ,'position'=>PM::get() ]);
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
              "name" =>$request->name,
              "email" =>$request->email,
              "password" => Hash::make($request->password),
              "lastname" =>$request->lastname,
              "position" =>$request->position,
              "department"=>$request->department,
              "prefix" =>$request->prefix,
              "type"=>0,
            ]);
           if( $data->update()) {
            if( $request->has('profile') ){
    
              if( !empty($data->profile) ){
                storage::disk('public')->delete( $data->profile );
              }
              $data->profile = $request->file('profile')->store('photo','public');
              $data->update();
            }
          }
              return redirect()->route('manageuser.index')->with('jsAlert', 'ข้อมูลสำเร็จ');
            
        }
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
