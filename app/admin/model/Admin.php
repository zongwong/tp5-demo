<?php

namespace app\admin\model;
use think\Loader;
use think\Model;
use think\validate;
class Admin extends Model
{
    protected $table = 'admin_user';
    protected $pk = 'user_id';
    
    public function checkLogin($data)
    {
        //1.数据验证
        $validate = Loader::validate('User');
        if(!$validate->check($data)){
            return ['code'=> 0 , 'msg'=>$validate->getError()];
        }
        //2.数据库验证
        $userInfo = $this->where('admin_username',$data['admin_username'])->where('admin_password',$data['admin_password'])->find();
        if(!$userInfo){
            return ['code'=> 0 , 'msg'=>'用户名或密码错误'];
        }else{
            //3.将信息存session   
            session('admin.admin_id',$userInfo['user_id']);
            session('admin.admin_username',$userInfo['admin_username']);
            return ['code'=> 1 , 'msg'=>'登陆成功'];
        }
    }
    public function editpass($data)
    {
        $rule = [
            'admin_password' => 'require',
            'new_password' => 'require',
            'confirm_password' => 'require|confirm:new_password',
        ];
        $msg = [
            'admin_password' => '原始密码不能为空',
            'new_password' => '新密码不能为空',
            'confirm_password.require' => '确认密码不能为空',
            'confirm_password.confirm'  => '两次密码不一致',
        ];
        $validate = new Validate($rule,$msg);
        $result = $validate->check($data);
        //1.验证器验证
        if(!$result){
            return ['code'=> 0 , 'msg'=>$validate->getError()];
        }
        //2.匹配原始密码
        $userInfo = $this->where('user_id',session('admin.admin_id'))->where('admin_password',$data['admin_password'])->find();
        if(!$userInfo){
            return ['code'=> 0 , 'msg'=>'原始密码错误'];
        }
         //3.保存新密码
        $res = $this->save([
            'admin_password' =>$data['new_password']
        ],[
            $this->pk => session('admin.admin_id')
        ]);
        if($res){
            return ['code'=> 1 , 'msg'=>'密码修改成功'];
        }else{
            return ['code'=> 0 , 'msg'=>'密码修改失败'];
        }
            

    }

}