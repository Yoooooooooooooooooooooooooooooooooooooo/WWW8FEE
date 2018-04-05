<?php
/**
 * Project name: WWW8FEE
 * File name: MessageBoard.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/5 21:51
 */

namespace app\message\model;


use think\Model;

class MessageBoard extends Model
{
    protected $pk = 'id';
    protected $table = '8f_message_board';

    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';

    public function profile()
    {
        return $this->hasOne('\app\common\model\User','uid')
            ->joinType('LEFTJOIN')
            ->bind(['uname'=>'nick']);
    }
}