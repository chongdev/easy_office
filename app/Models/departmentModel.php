<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class departmentModel extends Model
{
    //
    protected $table ="department";
    protected $fillable =["name"];
    public $pimarykey="id";
}
