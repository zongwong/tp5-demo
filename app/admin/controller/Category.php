<?php
namespace app\admin\controller;
class Category extends Common
{
    protected $db;
    protected function _initialize(){ //控制器初始化
        $this->db = new \app\admin\model\Category();
    }
    public function index(){
        $result = db('category')->select();
        $this->assign('category',$result);
        return $this->fetch();
    }
    public function store(){
        if(input('param.cate_id')){
            $cateid = input('param.cate_id');
            $cateInfo = db('category')->where('cate_id',$cateid)->find();
            $this->assign('cateInfo',$cateInfo);
        }else{
            $this->assign('cateInfo','0');
        }
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            dump($res);
        }
        return $this->fetch();
    }
    public function edit(){
        if(input('param.cate_id')){
            $cateid = input('param.cate_id');
        }
        $oldCateInfo = db('category')->where('cate_id',$cateid)->find();
        $this->assign('oldCateInfo',$oldCateInfo);
        $cateData = db('category')->select();//不包括自己及自己的子类
        $this->assign('cateData',$cateData);

        if(request()->isPost()){
            dump(input('post.'));
            $res = $this->db->edit(input('post.'),$cateid);
            dump($res);
        }

        return $this->fetch();
    }
}