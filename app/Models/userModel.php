<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
class userModel extends Model
{
    //
    protected $table ="users";
    protected $fillable =["name","email","password","lastname","position","department","prefix","type",];
    public $pimarykey="id";
}
