<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct ( Request $request = null )
	{
		parent::__construct( $request );
		//执行登录验证
		//$_SESSION['admin']['admin_id'];
		// dump(!session('admin.admin_id'));die;
		if(!session('admin.admin_id'))
		{
			$this->redirect('admin/Login/index');
		}
	}
}
