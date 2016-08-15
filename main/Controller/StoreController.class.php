<?php
class StoreController extends ArController
{
    // 初始化方法
    public function init()
    {
        // web插件模式全部得益于Seg片段的开发 高效共用前端模块组件
        // 调用layer插件
        arSeg(array(
                'loader' => array(
                    'plugin' => 'layer',
                    'this' => $this
                )
            )
        );
        // 自动引入的css文件 包含bootstrap.min.css style.css 引入规则：首先检查项目Public arCfg('PATH.PUBLIC'); 然后检查全局Public目录 arCfg('PATH.GPUBLIC')
        $this->assign(array('cssInsertBundles' => array('bootstrap.min', 'style')));
        // 自动引入的js 文件 包含bootstrap.min.js script.js
        $this->assign(array('jsInsertBundles' => array('bootstrap.min', 'script')));

    }
    public function storeAction()
    {
        $data=StoreModel::model()->getDb()->queryAll();
        $this->assign(array('stores'=>$data));
        $this->display();
    }
    public function store_addAction()
    {
        $data=arPost();
        if(!empty($data)){
            $result=StoreModel::model()->getDb()->insert($data);
            if($result){
                $this->redirectSuccess('Store/store','操作成功',2);
            }else{
                $this->redirectError('Store/store','操作失败',2);
            }
        }else{
               $this->display();
            }
    }
    public function store_upAction()
    {
        $data=arPost();
        $id=arGet('id');
        if (!empty($id) && empty($data)) {
            $store = StoreModel::model()->getDb()
                ->where(array('id' => $id))
                ->queryRow();
            //var_dump($workers);
            $this->assign(array('store' => $store));
            $this->display();
        }
        else if (!empty($data) && empty($id)) {
            $id=$data['id'];
            $workers = StoreModel::model()->getDb()
                ->where(array('id' => $id))
                ->update($data);
                $this->redirectSuccess('Store/store', '操作成功', 2);
                // echo"<script>alert('操作成功！');location.href='worker';</script>";
        }else{
            $this->redirectError('Store/store', '操作失败', 2);
            // echo"<script>alert('操作错误！');location.href='worker';</script>";
        }
    }
     public function storeDeleteAction()
    {
        $id = arPost('id');
        //echo $id;
        if ($id) {
            $res = StoreModel::model()->getDb()
                ->where(array('id' => $id))
                ->delete();
            if ($res) {
                $this->showJsonSuccess();
            } else {
                $this->showJsonError();
            }
        } else {
            $this->showJsonError();
        }
    }
}