<?php
/**
 * Project name: WWW8FEE
 * File name: Base.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/1 0:34
 */

namespace app\common\controller;


use think\Controller;

class Base extends Controller
{
    public function _empty($s)
    {
        $this->redirect("/");
    }

    protected function initialize()
    {}
}