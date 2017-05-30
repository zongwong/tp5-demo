<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model;
class Login extends Controller
{
    public function index()
    {
        // $data = db('admin_user')->find(2);
        if(request()->isPost()){
           $res =(new \app\admin\model\Admin()) -> checkLogin(input('post.'));
           if(!$res['code']){
               $this -> error($res['msg']);exit;
           }else{
            //    $this -> success($res['msg'],'admin/Index/index');exit;
            return $this->redirect('index/index');
           }
        }

        return $this->fetch();
    }
    public function logout()
    {
        session('admin.admin_id',null);
        $this -> success('退出登录成功','index');
    }
} 