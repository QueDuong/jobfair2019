<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Candidates extends Model
{
    //
    
    protected $table='candidates';

    protected $fillable = [ 'id','code','firstName','midleName','lastName','firstNameJ','midleNameJ','lastNameJ'
 ,'birth','mobile','email','sex','married','university','majors','graduatesY','graduatesM'
 ,'currentAdd','birthPlace','otherBirth','jLevel','eLevel','toeic','workPlace','workPlaceTxt','source'
 ,'situation','universityName','interview','plan','mandan','mandanDate','workcheck'
 ,'workDate','majorsTxt','otherIT','otherTech','otherLab','other','otherFin','pwd','col1','selfPR','coporations','fbook','created_at','updated_at'];

     public $sortable = [ 'id','code','firstName','midleName','lastName','firstNameJ','midleNameJ'
     ,'lastNameJ' ,'birth','mobile','email','sex','married','university','majors','graduatesY','graduatesM'
 ,'currentAdd','birthPlace','otherBirth','jLevel','eLevel','toeic','workPlace','workPlaceTxt','source'
 ,'situation','universityName','interview','plan','mandan','mandanDate','workcheck'
 ,'workDate','majorsTxt','otherIT','otherTech','otherLab','other','otherFin','pwd','col1','selfPR','coporations','fbook','created_at','updated_at'];

   
}
