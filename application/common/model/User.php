<?php
/**
 * Project name: WWW8FEE
 * File name: User.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/4 20:50
 */

namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $pk = 'id';
    protected $table = '8f_user';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dataFormat = "Y-m-d H:i:s";

    public function getAccessAttr($value)
    {
        $access = ['0'=>'普通用户','1'=>'塑料会员','2'=>'青铜会员','3'=>'白银会员','4'=>'黄金会员','5'=>'钻石会员','-1'=>'管理员'];
        return $access[$value];
    }

    public function setPwdAttr($value)
    {
        return sha1($value);
    }
}