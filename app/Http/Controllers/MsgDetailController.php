<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MsgDetailController extends Controller
{
    public function index($id)
    {
        $chat_user = User::find($id);
        return view('msgDetail', [
            'chat_user' => $chat_user,
            'user_id' => Auth::id()
        ]);
    }

    public function store(Request $request)
    {
        // 获取当前登录用户的ID作为发送者ID
        $sendUserId = Auth::id();

        // 从请求中获取接收者ID和消息内容
        $receiveUserId = $request->input('user_id');
        $content = $request->input('message');

        // 创建一个新的Message实例
        $message = new Message();
        $message->send_user_id = $sendUserId;
        $message->receive_user_id = $receiveUserId;
        $message->content = $content;

        // 保存消息到数据库
        $message->save();

        // 返回成功响应或执行其他操作
        return response()->json(['status' => 'Message sent', 'message' => $message], 200);
    }
}
