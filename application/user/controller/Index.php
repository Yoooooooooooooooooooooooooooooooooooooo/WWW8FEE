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
use app\common\model\User;
use think\facade\Request;
use think\facade\Session;
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

    public function loginCheck()
    {
        if(Request::isAjax())
        {
            $data = Request::post();
            $rule = [
                'uname|用户名'=>'require',
                'pwd|密码'=>'require'
                ];
            $result = $this->validate($data, $rule);
            if(true !== $result)
            {
                return ['status' => 0, 'message' => $result];
            }
            else{
                $query_result = User::get(function ($query) use ($data)
                {
                    $query->where('uname', $data['uname'])
                        ->where('pwd', sha1($data['pwd']));
                });
                if(null == $query_result)
                {
                    return ['status' => 0, 'message' => '用户名或密码不正确'];
                }
                else
                {
                    Session::set('user_id', $query_result ->id);
                    Session::set('user_name', $query_result ->uname);
                    return ['status' => 1, 'message' => '登录成功'];
                }
            }
        }
        else{
            $this->error("请求类型错误","login");
        }
    }

    public function registerCheck()
    {
        if(Request::isAjax())
        {
            $data = Request::except('pwd_confirm', 'post');
            $rule = 'app\common\validate\User';
            $result = $this->validate($data, $rule);
            if(true !== $result)
            {
                return ['status' => -1, 'message' => $result];
            }
            else
            {
                if(User::create($data))
                {
                    return ['status' => 1, 'message' => '注册成功'];
                }
                else
                {
                    return ['status' => 0, 'message' => '注册失败'];
                }
            }
        }
        else{
            $this->error("请求类型错误","register");
        }
    }
}