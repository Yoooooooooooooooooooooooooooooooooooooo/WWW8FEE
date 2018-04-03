<?php
namespace app\index\controller;

use app\common\controller\Base;
use app\index\model\NaviSite;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        $sites = NaviSite::field('name,url,status')
            ->where('status','in','1,2')
            ->where('url','<>', '')
            ->order('sort', 'asc')
            ->select();
//        return $this->display($content);//$this->view->display($content);  \think\facade\View::display($content);
        View::assign('title', "不知道要叫什么的网站");
        View::assign('sites', $sites);
        return View::fetch();
    }
}
