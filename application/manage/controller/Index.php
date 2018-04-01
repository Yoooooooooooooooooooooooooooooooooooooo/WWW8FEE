<?php
/**
 * Project name: WWW8FEE
 * File name: Index.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/1 17:48
 */

namespace app\manage\controller;


use app\common\controller\Base;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        View::assign("title","不知道要管理什么的页面");
        return View::fetch();
    }
}