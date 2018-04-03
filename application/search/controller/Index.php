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
use app\search\model\SearchSite;
use think\facade\Url;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        $sites = SearchSite::field('id,name,url')->order('sort', 'asc')->select();
        View::assign("sites", $sites);
        View::assign("title","这是一个搜索页");
        return View::fetch();
    }

    public function search($id_left=0,$id_right=0,$word="")
    {
        $sites = SearchSite::field('id,name,url')->order('sort', 'asc')->select();
        View::assign("sites", $sites);
        View::assign("word", $word);
        $left_url = SearchSite::field('url')->where('id',$id_left)->find()['url'];
        $right_url = SearchSite::field('url')->where('id',$id_right)->find()['url'];
        View::assign("url_left", empty($left_url) ? $sites[0]['url'] : $left_url);
        View::assign("url_right", empty($right_url) ? $sites[1]['url'] : $right_url);
        View::assign("title","这是一个搜索页");
        return View::fetch();
    }
}