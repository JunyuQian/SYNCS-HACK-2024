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

//        $user = User::find($userId);

        dd($this->getMessagesList($userId));

        return view('msg');
    }

    public function getMessagesList($userId)
    {
        $subQuery = Message::select(DB::raw('GREATEST(send_user_id, receive_user_id) as user_key, MAX(id) as latest_message_id'))
            ->where(function ($query) use ($userId) {
                $query->where('send_user_id', $userId)
                    ->orWhere('receive_user_id', $userId);
            })
            ->groupBy('user_key');

        $latestMessages = Message::joinSub($subQuery, 'latest_messages', function ($join) {
            $join->on('messages.id', '=', 'latest_messages.latest_message_id');
        })
            ->orderBy('messages.created_at', 'desc')
            ->get();

        return $latestMessages;
    }
}
