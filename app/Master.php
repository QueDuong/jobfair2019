<?php

namespace App;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    //
   
    protected $table='master';
 	protected $fillable = ['id','code','name','type','sort','typeName','crUser','udpUser','created_at','updated_at'];
    public $sortable = ['id','code','name','type','sort','typeName','crUser','udpUser','created_at','updated_at'];

}
