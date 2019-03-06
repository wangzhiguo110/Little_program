<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonus extends Model
{
    protected $table="bs_bonus";

    public static function getBonusInfo($id){
    	$bonus=self::where('id',$id)->first();
    	return $bonus;
    }
}
