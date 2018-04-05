<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::domain('s', function () {
    Route::rule('w/:id_left/:id_right/:word', 'search/index/search')
        ->pattern(['word' => '.*',
            'id_left' => '\d*',
            'id_right' => '\d*']);
    Route::bind('search/index');
    });

Route::domain('manage', 'manage/index');

Route::rule('user/login/:goto?', 'user/index/login')
    ->pattern(['goto' => '.*']);

Route::rule('user/register/:goto?', 'user/index/register')
    ->pattern(['goto' => '.*']);

Route::post('user/loginCheck', 'user/index/loginCheck');

Route::post('user/registerCheck', 'user/index/registerCheck');

Route::rule('message/board', 'message/index/board');

Route::rule('message/sendMessage', 'message/index/sendMessage');

return [

];