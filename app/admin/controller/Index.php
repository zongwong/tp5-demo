<?php
namespace app\admin\controller;
use app\admin\model;
class Index extends Common
{
    public function index()
    {
        return $this->fetch();
    }
    public function editpass()
    {
        if(request()->isPost()){
            $data = input('post.');
            $res = (new \app\admin\model\Admin())->editpass($data);
            if(!$res['code']){
                $this->error($res['msg']);
            }else{
                $this->success($res['msg'],'index');
            }
        }
       
        return $this->fetch();
    }
}
