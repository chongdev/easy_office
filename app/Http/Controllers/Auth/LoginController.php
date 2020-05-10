<?php

namespace App\Http\Controllers\Auth;
use auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
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
        return '/home';
    }
}
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
