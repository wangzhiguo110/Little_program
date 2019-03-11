<?php
namespace  App\Tools;

//公共方法类
class ToolsAdmin
{
//    无限级分类的数据组装
    public  static function  buildTree($data,$fid=0){
        if(empty($data)){
            return [];
        }

        static $menus=[];//定义一个静态变量，用来存储无线级分类的数据
        foreach($data as $key =>$value){
//            dd($value);
            if($value['fid']==$fid){//当前循环内容中的fid是否等于函数fid参数
                if(!isset($menus[$value['fid']])){//如果key值不存在
                    $menus[$value['id']]=$value;
                }else{
                    $menus[$value['fid']]['son'][$value['id']]=$value;
                }
                //删除已经添加过的数据
                unset($data[$key]);

                self::buildTree($data,$value['id']);//执行递归调用
            }
        }
        return $menus;
    }
}