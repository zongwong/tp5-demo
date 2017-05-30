<?php

namespace app\admin\controller;
use think\Controller;

class Link extends controller
{
    public function index(){
        return $this->fetch();
    }
}