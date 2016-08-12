<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/3
 * Time: 14:28
 */
class AdminModel extends ArModel
{
    public $tableName = 's_admin';

    static public function model($class = __CLASS__)
    {
        return parent::model($class);
    }
    
    public static function gPwd($pwd)
    {
        return md5(md5($pwd));
    }
}