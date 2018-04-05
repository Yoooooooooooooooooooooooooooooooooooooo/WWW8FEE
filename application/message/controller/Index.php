<?php
/**
 * Project name: WWW8FEE
 * File name: Index.php
 *
 * Description:
 *
 * User: L
 * Create on: 2018/4/5 16:06
 */

namespace app\message\controller;

use app\common\controller\Base;
use app\message\model\MessageBoard;
use think\facade\Log;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Index extends Base
{
    public function board()
    {
        $messages = MessageBoard::alias('mb')
            ->field('uid,content,mb.create_time,user.uname nick')
            ->where('mb.status','=',1)
            ->leftJoin('user', 'mb.uid=user.id')
            ->order('mb.create_time', 'desc')
            ->select();
        View::assign('messages',$messages);
        View::assign('title', '简易留言板');
        return View::fetch();
    }

    public function sendMessage()
    {
        if(Request::isAjax())
        {
            if(Session::get('user_id') == 0)
            {
                $this->error("账号已过期，请重新登录","/user/login/message/board");
            }
            $data = Request::post();
            $data['uid'] = Session::get('user_id');
            $data['ip'] = Request::ip();
            $result = $this->validate($data,
                ['content'=>'require|length:1,1000'],
                ['content.require'=>'想说话不能不出声',
                 'content.length'=>'纵使千言万语，也要概括中心思想']);
            if($result !== true)
            {
                return ['status' => 0, 'message' => $result];
            }
            if(MessageBoard::create($data))
            {
                return ['status' => 1, 'message' => '发送成功'];
            }
            else{
                return ['status' => -1, 'message' => '发送失败'];
            }
        }
        else {
            $this->error("请求类型错误","board");
        }

    }

}