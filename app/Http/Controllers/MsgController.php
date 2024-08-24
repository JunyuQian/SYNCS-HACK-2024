<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MsgController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $list = $this->getMessagesList($userId);

        return view('msg', ['list' => $list]);
    }

//    public function getMessagesList($userId)
//    {
//        return Message::with(['sender', 'receiver'])
//            ->where(function ($query) use ($userId) {
//                $query->where('send_user_id', $userId)
//                    ->orWhere('receive_user_id', $userId);
//            })
//            ->orderBy('created_at', 'desc')
//            ->get()
//            ->map(function ($message) use ($userId) {
//                // 判断当前用户是发送者还是接收者，并设置对方用户
//                if ($message->send_user_id == $userId) {
//                    $message->other_user = $message->receiver;
//                } else {
//                    $message->other_user = $message->sender;
//                }
//                return $message;
//            });
//    }
    public function getMessagesList($userId)
    {
        // 子查询：获取每个对话的最后一条消息的ID
        $lastMessageIds = Message::select(DB::raw('MAX(id) as id'))
            ->where(function ($query) use ($userId) {
                $query->where('send_user_id', $userId)
                    ->orWhere('receive_user_id', $userId);
            })
            ->groupBy(DB::raw('LEAST(send_user_id, receive_user_id), GREATEST(send_user_id, receive_user_id)'))
            ->pluck('id');

        // 主查询：获取最后一条消息的详细信息
        return Message::with(['sender', 'receiver'])
            ->whereIn('id', $lastMessageIds)
            ->get()
            ->map(function ($message) use ($userId) {
                // 判断当前用户是发送者还是接收者，并设置对方用户
                if ($message->send_user_id == $userId) {
                    $message->other_user = $message->receiver;
                } else {
                    $message->other_user = $message->sender;
                }
                return $message;
            });
    }
}
