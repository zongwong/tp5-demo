<?php
namespace app\index\controller;
use think\Request;
class Index
{
    public function index(Request $request)
    {
    
        $this->fetch();
    }
}
