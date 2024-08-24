<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'send_user_id',
        'receive_user_id',
        'content',
        'is_read', // Assuming you have this field to track read status
    ];

    // 定义发送者的关系
    public function sender()
    {
        return $this->belongsTo(User::class, 'send_user_id');
    }

    // 定义接收者的关系
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receive_user_id');
    }
}
