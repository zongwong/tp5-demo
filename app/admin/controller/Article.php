<?php

namespace app\admin\controller;
use think\Controller;

class Article extends controller
{
    public function index(){
        return $this->fetch();
    }
    public function recycle(){
        return $this->fetch();
    }
}