<?php
/**
 * Project name: WWW8FEE
 * File name: Index.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/1 21:44
 */

namespace app\search\controller;


use app\common\controller\Base;
use think\facade\Url;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        View::assign("title","这是一个搜索页");
        return View::fetch();
    }

    public function search($word="")
    {
        View::assign("title","这是一个搜索页");
        View::assign("word",$word);
        return View::fetch();
    }
}