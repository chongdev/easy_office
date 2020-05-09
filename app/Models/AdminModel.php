<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    //
    protected $table ="users";
    protected $fillable =["name","email","password","lastname","position","department","prefix","type",];
    public $pimarykey="id";

    public function lists($requert){
        $query = DB::table($this->table)
            ->select("{$this->table}.*","department.name as departmentname","position.name as positionname")
            ->leftjoin('department',"{$this->table}.department","=","department.id")
            ->leftjoin('position',"{$this->table}.position","=","position.id")
;
    }
}
