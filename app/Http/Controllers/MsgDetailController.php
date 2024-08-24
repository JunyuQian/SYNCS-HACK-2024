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
        // 从请求中获取接收者ID和消息内容
        $receiveUserId = $request->input('receive_user_id');
        $sendUserId = $request->input('send_user_id');
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

    public function getMessagesBetweenUsers($user1, $user2)
    {
        // 查询user1和user2之间的所有消息
        $messages = Message::where(function($query) use ($user1, $user2) {
            $query->where('send_user_id', $user1)
                ->where('receive_user_id', $user2);
        })
            ->orWhere(function($query) use ($user1, $user2) {
                $query->where('send_user_id', $user2)
                    ->where('receive_user_id', $user1);
            })
            ->orderBy('created_at', 'asc') // 按时间顺序排序
            ->get();

        // 返回JSON响应
        return response()->json($messages);
    }
}
