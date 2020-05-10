<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    //
    protected $table ="letter";
    protected $fillable =["dear","U_id","address","date","Title","position_id","vacation_Name","etc","detail","since","todate","alltime","contacted","status","approve"];
    public $pimarykey="id";
    public $requert = "ไม่";
    public function lists($requert){
        $query = DB::table('users')
        ->select("*","users.id as id","users.name as username","department.name as departmentname","position.name as positionname",)
        ->leftjoin('department',"department.id","=","users.department")
        ->leftjoin('position',"position.id","=","users.position");
        
        if(!empty($requert->search)){
            $query->where(function($q) use ($requert) {
                $q->where("{$this->table}.status",'LIKE',"%{$requert->search}%");
                $q->orWhere("{$this->table}.address",'LIKE',"%{$requert->search}%");
        
            });
        }
        if(!empty($requert->type)){
                $query->Where("{$this->table}.type",'LIKE',$requert->type);
            }
                
        if(!empty($requert->store)){
                $query->Where("{$this->table}.store_id",'LIKE',$requert->store);
            }
        return $query->paginate($requert->limit);
    
       
        }
}
