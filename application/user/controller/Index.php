<?php
/**
 * Project name: WWW8FEE
 * File name: Index.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/4 20:36
 */

namespace app\user\controller;

use app\common\controller\Base;
use think\facade\View;

class Index extends Base
{
    public function login()
    {
        View::assign('title', "登录");
        return View::fetch();
    }

    public function register()
    {
        View::assign('title', "注册");
        return View::fetch();
    }
}