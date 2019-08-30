<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Candidates_2018_05 extends Model
{
    //
    
    protected $table='candidates_2018_05';
    protected $fillable = ['id','name','birthday','email','tel','password','university_id','sex','university_name','department','is_graduated','graduate_date','japanese_level_id','english_level_id','address_id','birth_place_id','work_place_id','coporations','subitems','itemsOther','itemsOtherFin','itemsOtherLab','itemsOtherTech','itemsOtherIT','birthplace_name','selfPR','address_name','other_certification'];
   
}
