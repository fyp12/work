<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 10:05
 */
class WorkerModel extends ArModel
{
    public $tableName = 'u_workers';

    static public function model($class = __CLASS__)
    {
        return parent::model($class);
    }
}