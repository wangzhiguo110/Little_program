<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonusRecord extends Model
{
    //
    protected $table="bs_bonus_record";

    public static function createRecord($data){
    	$res=self::insert($data);
    	return $res;
    } 
    // 获取最大金额的红包
    public static function getMaxBonus($bonusId){
    		$res=self::select('id')
    			  ->where('bounus_id',$bounusId)
    			  ->orderBy('money','desc')
    			  ->first();
    	    return $res;
    }

    public static function updateBonusRecord($data,$id){
    	return self::where('id',$id)->update($data);
    }

    public  static function getRecordById($userId,$bonusId){
    	return self::where('user_id',$userId)
    				->where('bonus_id',$bonusId)
    				->first();
    }
}
