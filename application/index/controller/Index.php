<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\index\model\NaviSites;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        $sites = NaviSites::field('name,site,status')
            ->where('status','in','1,2')
            ->where('site','<>', '')
            ->order('sort', 'asc')
            ->select();
//        return $this->display($content);//$this->view->display($content);  \think\facade\View::display($content);
        View::assign('title', "不知道要叫什么的网站");
        View::assign('sites', $sites);
        return View::fetch();
    }
}
