<?php
/**
 * Powerd by ArPHP.
 *
 * Controller.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */

/**
 * Default Controller of webapp.
 */
class IndexController extends ArController
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

    // 默认第一个方法
    public function indexAction()
    {
        if (!$_SESSION['admin']['username']) {
            $this->redirectError('Index/login', '请登录', 2);
        }
        $year = arPost('year');
        $month = arPost('month');
        $type = arRequest('type');
        if ($type == 1) {
            if ($year && $month) {
                $startTime = mktime(0, 0, 0, $month, 0, $year);
                $endTime = mktime(0, 0, 0, $month + 1, 0, $year);

            }
        } elseif ($type == 2) {

        }
        // 设置头尾文件 默认为header.html footer.html
        // $this->setLayoutFile('user');
        // 显示模板
        $this->display();

    }

    public function loginAction()
    {
        $data = arPost();
        if ($data) {
            $data['password'] = AdminModel::gPwd($data['password']);
            $res = AdminModel::model()->getDb()
                ->where($data)
                ->queryRow();
            if ($res) {
                $_SESSION['admin'] = $res;
                $this->redirectSuccess('Index/index', '登录成功', 2);
            }
        }
        $this->display();
    }

    public function workerAction()
    {
        $store = arPost();
        if ($store) {
            $workers = WorkerModel::model()->getDb()
                ->where(array('store' => $store))
                ->queryAll();
            $this->assign(array('workers' => $workers));
            $this->display();
        }
        $workers = WorkerModel::model()->getDb()->queryAll();
        $this->assign(array('workers' => $workers));
        $this->display();
    }
    public function work_addAction()
    {
        $data=arPost();
        //var_dump($data);
        if(!(empty($data))){
            $data['store']=StoreModel::getId($data['store']);
            //var_dump($data['store']);exit();
            $result=WorkerModel::model()->getDb()->insert($data);
            if($result){
                $this->redirectSuccess('Index/worker', '操作成功', 2);
                // echo"<script>alert('操作成功！');location.href='worker';</script>";
            }else{
                $this->redirectError('Index/worker', '操作失败', 2);
                // echo"<script>alert('操作失败！');</script>";
            }
        }else{
            $this->assign(array('stores'=>StoreModel::queryAll()));
            $this->display();
        }
    }
    public function storeAction()
    {
        var_dump(StoreModel::queryName());
    }
    public function work_upAction()
    {
        $data = arPost();
        $id=arGet('id'); 
        if (!empty($id) && empty($data)) {
            $workers = WorkerModel::model()->getDb()
                ->where(array('id' => $id))
                ->queryAll()[0];
            //var_dump($workers);
            $workers['store']=StoreModel::getName($workers['store']);
            $this->assign(array('stores'=>StoreModel::queryAll()));
            $this->assign(array('worker' => $workers));
            $this->display();
        }
        else if (!empty($data) && empty($id)) {
            $id=$data['id'];
            $data['store']=StoreModel::getId($data['store']);
            $workers = WorkerModel::model()->getDb()
                ->where(array('id' => $id))
                ->update($data);
                $this->redirectSuccess('Index/worker', '操作成功', 2);
                // echo"<script>alert('操作成功！');location.href='worker';</script>";
        }else{
            $this->redirectError('Index/worker', '操作失败', 2);
            // echo"<script>alert('操作错误！');location.href='worker';</script>";
        }
    }
    public function workerDeleteAction()
    {
        $id = arPost('id');
        if ($id) {
            $res = WorkerModel::model()->getDb()
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