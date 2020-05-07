<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class positionModel extends Model
{
    //
    protected $table ="position";
    protected $fillable =["name"];
    public $pimarykey="id";
}
