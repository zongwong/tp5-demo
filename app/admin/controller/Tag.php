<?php

namespace app\admin\controller;
use think\Controller;

class Tag extends controller
{
    public function index(){
        return $this->fetch();
    }
}