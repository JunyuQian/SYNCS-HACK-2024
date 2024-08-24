<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message List</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f6f6f6;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .message-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
            background-color: #f6f6f6;
        }

        .message-item {
            display: flex;
            align-items: center;
            padding: 28px 15px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .message-item:hover {
            background-color: #f5f5f5;
        }

        .message-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message-content {
            flex-grow: 1;
        }

        .message-title {
            font-size: 16px;
            color: #333;
            margin: 0;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .message-text {
            font-size: 14px;
            color: #999;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .message-time {
            font-size: 12px;
            color: #ccc;
            margin-left: 10px;
            white-space: nowrap;
        }

        .unread-dot {
            width: 8px;
            height: 8px;
            background-color: red;
            border-radius: 50%;
            margin-left: 10px;
        }

        .no-messages {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%; /* 让容器填满父元素的高度 */
            text-align: center;
        }


        .no-messages svg {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
            fill: #ccc;
        }

        .no-messages p {
            font-size: 16px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="header">
    Message
</div>

@if($list->isEmpty())
    <!-- 无消息时显示 -->
    <div class="no-messages">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.867 8.167 6.84 9.497-.095-.82-.183-2.08.038-2.974.2-.84 1.288-5.363 1.288-5.363s-.326-.654-.326-1.619c0-1.517.88-2.648 1.975-2.648.931 0 1.38.698 1.38 1.536 0 .936-.597 2.336-.906 3.636-.258 1.092.548 1.981 1.623 1.981 1.948 0 3.452-2.055 3.452-5.015 0-2.621-1.883-4.459-4.573-4.459-3.117 0-4.942 2.34-4.942 4.755 0 .938.36 1.945.81 2.49.09.107.104.2.077.31-.084.338-.274 1.092-.311 1.242-.05.204-.162.248-.374.149-1.4-.654-2.273-2.706-2.273-4.354 0-3.547 2.578-6.804 7.436-6.804 3.906 0 6.942 2.787 6.942 6.508 0 3.875-2.447 7.005-5.85 7.005-1.142 0-2.215-.593-2.58-1.289l-.702 2.676c-.254.998-.948 2.247-1.415 3.003C9.884 21.886 10.928 22 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/>
        </svg>
        <p>No messages yet.</p>
    </div>
@else
    <ul class="message-list">
        @foreach($list as $msg)
            <li class="message-item" data-url="{{ url('message/'.$msg->other_user->id) }}">
                <img src="{{ url('images/'.$msg->other_user->photo) }}" alt="User {{ $msg->other_user->name }}">
                <div class="message-content">
                    <p class="message-title">{{ $msg->other_user->name }}</p>
                    <p class="message-text">{{ $msg->content }}</p>
                </div>
                <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>
                @if(!$msg->is_read)
                    <div class="unread-dot"></div>
                @endif
            </li>
        @endforeach
    </ul>

@endif

<x-tag />

<script>
    document.querySelectorAll('li').forEach(function(li) {
        li.addEventListener('click', function() {
            var url = this.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });
    });
</script>

</body>
</html>
