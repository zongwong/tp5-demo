<?php
namespace app\admin\model;
use think\Model;
use think\Loader;
class Category extends Model
{
    protected $pk = 'cate_id';
    protected $table ='category';
    public function store($data){
        //1.验证器验证
        $validate = Loader::validate('Category');
        if(!$validate->check($data)){
            return ['code'=> 0,'msg'=>$validate->getError()];
        }
        //2.名称查重
        $cateInfo = $this->where('cate_name',$data['cate_name'])->find();
        if($cateInfo){
            return ['code'=> 0,'msg'=>'栏目名称已存在'];
        }
        //3.数据保存
        $res = $this->save([
             'cate_name'=>$data['cate_name'],
             'cate_pid'=>$data['cate_pid'],
             'cate_sort'=>$data['cate_sort'],
             ]);
        if($res){
            return ['code'=> 1,'msg'=>'栏目添加成功'];
        }else{
            return ['code'=> 1,'msg'=>'栏目添加失败'];
        }
       
    }
    public function edit($data,$cateid){
        //1.验证器验证
        $validate = Loader::validate('Category');
        if(!$validate->check($data)){
            return ['code'=> 0,'msg'=>$validate->getError()];
        }
        //2.名称查重(不包括自己,pid也不能是自己)
        $cateInfo = $this->where('cate_name',$data['cate_name'])->find();
        if($cateInfo){
            return ['code'=> 0,'msg'=>'栏目名称已存在'];
        }
        //3.数据保存
        $res = $this->save([
             'cate_name'=>$data['cate_name'],
             'cate_pid'=>$data['cate_pid'],
             'cate_sort'=>$data['cate_sort'],
             ],[
                'cate_id'=>$cateid
             ]);
        if($res){
            return ['code'=> 1,'msg'=>'栏目修改成功'];
        }else{
            return ['code'=> 1,'msg'=>'栏目修改失败'];
        }
       
    }
}