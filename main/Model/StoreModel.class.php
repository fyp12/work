<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 14:28
 */
class StoreModel extends ArModel
{
    public $tableName = 'u_store';

    static public function model($class = __CLASS__)
    {
        return parent::model($class);
    }
    
    public static function queryAll()
    {
        $result=self::model()->getDb()
               ->queryAll();
        return $result;
    }
    //  public static function getId($name)
    // {
    //     $result=self::model()->getDb()
    //             ->where("name='".$name."'")
    //            ->queryAll();
    //            //var_dump($result);exit();
    //     return $result[0]['id'];
    // }
     public static function getName($id)
    {
        $result=self::model()->getDb()
                ->where("id='".$id."'")
               ->queryRow();
              // var_dump($result);exit();
        return $result['name'];
    }
}