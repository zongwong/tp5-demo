<?php

namespace app\admin\controller;
use think\Controller;

class Webset extends controller
{
    public function index(){
        return $this->fetch();
    }
}