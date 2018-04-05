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
    public function login($goto="")
    {
        View::assign('title', "登录");
        View::assign('goto', $goto);
        return View::fetch();
    }

    public function register($goto="")
    {
        View::assign('title', "注册");
        View::assign('goto', $goto);
        return View::fetch();
    }

    public function loginCheck()
    {
        if(Request::isAjax())
        {
            $data = Request::post();
            $rule = [
                'uname|用户名'=>'require|alphaDash|length:6,15',
                'pwd|密码'=>'require|length:6,16|alphaDash',
                ];
            $message = [
                'uname.require' => '用户名或密码输入有误',
                'uname.alphaDash' => '用户名或密码输入有误',
                'uname.length' => '用户名或密码输入有误',
                'pwd.require' => '用户名或密码输入有误',
                'pwd.length' => '用户名或密码输入有误',
                'pwd.alphaDash' => '用户名或密码输入有误',
            ];
            $result = $this->validate($data, $rule, $message);
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
            $result = $this->validate($data, 'app\common\validate\User');
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