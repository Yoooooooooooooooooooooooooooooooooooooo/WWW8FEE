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

class User extends \think\Validate
{
    protected  $rule = [
        'uname|用户名'=>'require|length:5,20|alphaNum|unique:8f_user',
        'email|邮箱'=>'require|email',
        'pwd|密码'=>'require|length:6,16|alphaNum|confirm',
    ];
}