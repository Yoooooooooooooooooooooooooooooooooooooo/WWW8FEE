<?php
namespace app\index\controller;

use app\index\model\NaviSites;
use think\Controller;
use think\facade\View;

class Index extends Controller
{
    public function index()
    {
        $sites = NaviSites::field('name,site,status')
            ->where('status','in','1,2')
            ->where('site','<>', '')
            ->order('sort', 'asc')
            ->select();
//        return $this->display($content);//$this->view->display($content);  \think\facade\View::display($content);

        View::assign('sites', $sites);
        return View::fetch();
    }
}
