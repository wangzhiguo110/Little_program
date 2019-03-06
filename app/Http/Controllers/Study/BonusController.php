<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Study\BsBonus;
use App\Study\BsBonusRecord;
use Log;
class BonusController extends Controller
{
    //
     public function index(){

     }

     public function getBonus(Request $request){
     		$params=$request->all();

     		$return=[
     			'code'=>2000,
     			'msg'=>'成功'
     		];

     		if(!isset($params['user_id'])||empty($params['user_id'])){
     			$return=[
     			'code'=>4001,
     			'msg'=>'用户未登录'
     			];
     			return json_encode($return);
     		}
     		if(!isset($params['bonus_id'])||empty($params['bonus_id'])){
     			$return=[
     			'code'=>4002,
     			'msg'=>'请选择指定红包'
     			]; 	
     			return json_encode($return);
     		}
       // 检测红包是否存在
       $bonus=BsBonus::getBonusInfo($params['bonus_id']);
       dd($bonus);
       if(empty($bonus)){
       	$return=[
       		'code'=>4003,
       		'msg'=>'红包不存在'
       	];
       	return json_encode($return);
       }

       $record=BsBonusRecord::getRecordById($params['user_id'],$params['bonus_id']);
       if($record){
       			$return=[
       				'code'=>4005,
       				'msg'=>'你已经抢过该红包了'
       			];
       }
      // 红包是否被抢光
      if($bonus->left_amount<=0||$bonus->left_nums<=0){
      		$return=[
       		'code'=>4003,
       		'msg'=>'红包已经被抢光'
       	];
       	return json_encode($return);
      }

      // 是否是最后一个红包
      if ($bounus->left_nums==1) {
      	$getMoney=$bonus->left_amount;

      	// 插入一条bonus_record的一条记录
      	$data=[
      		'user_id'=>$params['user_id'],
      		'bounus_id'=>$params['bonus_id'],
      		'money'=>$getMoney,
      		'flag'=>1
      	];
      	BsBonusRecord:createdRecord($data);
      	// 更新红包表的数据
      	$data1=[
      		'left_amount'=>0,
      		'left_nums'=>0
      	];

      	BsBonus::updateBonusInfo($data1,$params['bounus_id']);
      	// 评选出运气王
      	// 1降序排列红包抢的记录
      	$res=BsBonusRecord::getMaxBonus($params['bounus_id']);

      	// 2.更新抢红包的记录
      	BsBonusRecord::updateBonusRecord(['flag'=>2],$res->id);
      }else{
      	$min=0.01;//最小金额
      	$max=$bonus->left_amount-($bonus->left_nums)*0.01;//最大金额
      	$getMoney=rand();//获取金额随机值

      	$data=[
      		'user_id'=>$params['user_id'],
      		'bonus_id'=>$params['bonus_id'],
      		'money'=>$getMoney,
      		'flag'=>1
      	];

      	BsBonusRecord::createdRecord($data);

      	// 跟新红包的金额
      	$data1=[
      		'left_amount'=>$bonus->left_amount-$getMoney,
      		'left_nums'=>$bonus->left_nums-1
      	];

      	BsBonus::updateBonusInfo($data1,$params['bonus_id']);
      }
      return json_encode($return);
      
     }
}
