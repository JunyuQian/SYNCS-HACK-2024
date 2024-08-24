<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        *{
            box-sizing: border-box;
            font-size: 24px;
        }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f6f6f6;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden; /* 防止页面溢出 */
        }

        .header {
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            flex-shrink: 0;
            width: 100%;
        }

        .chat-container {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .message {
            max-width: 70%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            font-size: 22px;
            line-height: 1.4;
            word-wrap: break-word;
            box-sizing: border-box;
        }

        .message.sent {
            align-self: flex-end;
            background-color: #DCF8C6;
        }

        .message.received {
            align-self: flex-start;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .input-container {
            display: flex;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            box-sizing: border-box;
        }

        .input-container input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
            font-size: 22px;
            box-sizing: border-box;
        }

        .input-container button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 20px;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
            box-sizing: border-box;
            white-space: nowrap;
        }

        .input-container button:disabled {
            background-color: #999;
        }
    </style>
</head>
<body>

<div class="header">
    Chat with User
</div>

<div class="chat-container">
    <div class="message received">
        Hi, how are you?
    </div>
    <div class="message sent">
        I'm good, thank you! How about you?
    </div>
    <div class="message received">
        I'm doing well. Thanks for asking.
    </div>
    <!-- 更多的消息 -->
</div>

<div class="input-container">
    <input type="text" placeholder="Type a message...">
    <button>Send</button>
</div>

<script>
    const inputField = document.querySelector('input[type="text"]');
    const sendButton = document.querySelector('button');
    const chatContainer = document.querySelector('.chat-container');

    sendButton.addEventListener('click', function() {
        const messageText = inputField.value.trim();
        if (messageText) {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'sent');
            messageElement.textContent = messageText;
            chatContainer.appendChild(messageElement);
            inputField.value = '';
            chatContainer.scrollTop = chatContainer.scrollHeight;

            // 构建POST请求
            fetch('http://127.0.0.1:8000/api/msg', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    send_user_id: {{ $user_id }},
                    receive_user_id: {{ $chat_user->id }},
                    message: messageText
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Message sent:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    });


    inputField.addEventListener('input', function() {
        sendButton.disabled = !inputField.value.trim();
    });


    function fetchMessages() {
        fetch(`http://127.0.0.1:8000/messages/{{ $user_id }}/{{ $chat_user->id }}`)
            .then(response => response.json())
            .then(messages => {
                chatContainer.innerHTML = '';
                messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message');
                    if (message.send_user_id === {{ $user_id }}) {
                        messageElement.classList.add('sent');
                    } else {
                        messageElement.classList.add('received');
                    }
                    messageElement.textContent = message.content;
                    chatContainer.appendChild(messageElement);
                });
                chatContainer.scrollTop = chatContainer.scrollHeight;
            })
            .catch((error) => {
                console.error('Error fetching messages:', error);
            });
    }
    fetchMessages()

    // 每1秒钟获取一次消息
    setInterval(fetchMessages, 1000);

</script>


</body>
</html>
