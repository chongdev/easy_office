<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class leavemodel extends Model
{
    //
    protected $table ="letter";
    protected $fillable =["dear","U_id","address","date","Title","position_id","vacation_Name","etc","detail","since","todate","alltime","contacted","status"];
    public $pimarykey="id";

}
