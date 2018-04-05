<?php
/**
 * Project name: WWW8FEE
 * File name: User.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/5 1:24
 */

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected  $rule = [
        'uname|用户名'=>'require|alphaDash|length:6,16|unique:user',
        'email|邮箱'=>'require|email',
        'pwd|密码'=>'require|length:6,16|alphaDash|confirm:repwd',
    ];

    protected $message = [
        'uname.require' => '必须输入用户名',
        'uname.length'  => '用户名必须在6-16个字符之间',
        'uname.unique'  => '用户名已存在',
        'email.require' => '必须输入邮箱',
        'email'         => '邮箱格式错误',
        'pwd.require'   => '必须输入密码',
        'pwd.length'    => '密码必须在6-16个字符之间',
    ];

}