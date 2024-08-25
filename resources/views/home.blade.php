<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .photo {
            width: 100%;
            height: 600px;
            margin: 0 auto;
        }
        .card{
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            position: absolute;
        }

        .card:first-child {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            cursor: grab;
            touch-action: none; /* 禁用浏览器默认的触摸行为（如滚动） */
            transition: transform 0.3s ease; /* 添加平滑的过渡效果 */
            z-index: 2;
        }
        .card:last-child{
            transform: scale(0.9) translateY(-50px);
            z-index: 1;
        }

        .card-box {
            width: 100%;
            margin: 50px auto;
            position: relative;
        }

        .info {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            color: white;
            padding: 40px 20px;
            font-family: Arial, sans-serif;
        }

        .info p {
            margin: 5px 0;
        }
        .info-name{
            font-size: 36px;
        }
        .info-major{
            color: orangered;
        }
        .info-skill span {
            margin: 5px;
        }

        #cross {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0); /* 中心对齐并缩放 */
            font-size: 150px;
            color: #fff;
            border-radius: 50%;
            background: red;
            opacity: 0;
            transition: all .5s;
            pointer-events: none;
            width: 200px;
            height: 200px;
            line-height: 225px;
            text-align: center;
            box-sizing: border-box;
            z-index: 999;
        }
        #cross img{
            width: 120px;
            height: 120px;
            color: white;
        }

        #msg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0); /* 中心对齐并缩放 */
            font-size: 50px;
            color: white;
            opacity: 0;
            transition: all .5s;
            pointer-events: none;
            background: dodgerblue;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            padding: 30px;
            box-sizing: border-box;
            z-index: 999;
        }
        #msg img{
            width: 140px;
            height: 140px;
        }
        /* Loading screen styles */
        #loading-screen {
            position: fixed;
            width: 100%;
            height: 100%;
            background: white; /* 背景颜色，可以根据需要更改 */
            z-index: 9999; /* 确保它在最上层 */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Loader animation */
        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        /* Keyframes for spin animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        header{
            padding: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            color: orangered;
        }
        .title{
            font-size: 26px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div id="loading-screen">
    <div class="loader"></div>
</div>
<header>
    <span class="title">TalentLink</span>

    <svg t="1724540770137" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4233" width="20" height="20"><path d="M577.499296 1023.99875a99.999878 99.999878 0 0 1-47.999942-11.999985l-131.999839-72.999911a99.999878 99.999878 0 0 1-51.999936-87.999893V431.999473a19.999976 19.999976 0 0 0-7.99999-15.999981L32.499961 171.99979l-3.999995-3.999995C0.5 138.99983-6.499991 96.999882 9.499989 59.999927S60.499927 0 100.499878 0h821.998997c39.999951 0 75.999907 22.999972 91.999887 59.999927s8.999989 77.999905-17.999978 107.999868l-3.999995 3.999995-307.999624 246.999699a19.999976 19.999976 0 0 0-6.999991 15.99998v488.999403a99.999878 99.999878 0 0 1-99.999878 99.999878zM84.499897 111.999863l302.999631 241.999705a98.999879 98.999879 0 0 1 37.999953 77.999905v418.999488a19.999976 19.999976 0 0 0 9.999988 17.999978l131.999839 71.999912a19.999976 19.999976 0 0 0 29.999963-17.999978V434.999469a99.999878 99.999878 0 0 1 36.999955-77.999905l303.999629-244.999701a19.999976 19.999976 0 0 0-15.99998-31.999961H100.499878a19.999976 19.999976 0 0 0-15.999981 31.999961z m881.998924 28.999965z" fill="currentColor" p-id="4234"></path><path d="M983.4988 520.999364H757.499076a39.999951 39.999951 0 0 1 0-79.999902h225.999724a39.999951 39.999951 0 0 1 0 79.999902zM983.4988 670.999181H757.499076a39.999951 39.999951 0 0 1 0-79.999902h225.999724a39.999951 39.999951 0 0 1 0 79.999902zM983.4988 819.998999H757.499076a39.999951 39.999951 0 0 1 0-79.999902h225.999724a39.999951 39.999951 0 0 1 0 79.999902z" fill="currentColor" p-id="4235"></path></svg>
</header>

<div class="card-box">
    @php
    $user1 = $users[0];
    $user2 = $users[1];
    @endphp
    <div class="card" id="draggableCard" data-id="{{ $user1['id'] }}">
        <div class="photo" style="background: url('{{ asset('images/'.$user1['photo']) }}') center / cover;"></div>
        <div class="info">
            <p class="info-name">{{$user1['name']}}</p>
            <p class="info-major">{{$user1['degree']}}</p>
            <p class="info-skill">
                @foreach(explode(';', $user1['skills']) as $skill)
                    <span>{{ $skill }}</span>
                @endforeach
            </p>
        </div>
    </div>
    <div class="card" data-id="{{ $user2['id'] }}">
        <div class="photo" style="background: url('{{ asset('images/'.$user2['photo']) }}') center / cover;"></div>
        <div class="info">
            <p class="info-name">{{$user2['name']}}</p>
            <p class="info-major">{{$user2['degree']}}</p>
            <p class="info-skill">
                @foreach(explode(';', $user2['skills']) as $skill)
                    <span>{{ $skill }}</span>
                @endforeach
            </p>
        </div>
    </div>
</div>
<div class="love"></div>
<div id="cross" class=""><img src="{{ asset('svg/cross.svg') }}" alt=""></div>
<div id="msg" class=""><img src="{{ asset('svg/chat.svg') }}" alt=""></div>
<x-tag />

<script>
    let card = document.getElementById('draggableCard');
    const cross = document.getElementById('cross');
    const msg = document.getElementById('msg');
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let isDragging = false;

    document.addEventListener('touchstart', function(e) {
        const card = document.getElementById('draggableCard');
        if (!card) return;

        isDragging = true;
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
        currentX = startX;
        currentY = startY;
        card.style.transition = 'none'; // 禁用过渡效果，用户拖动时体验更好
    });

    document.addEventListener('touchmove', function(e) {
        const card = document.getElementById('draggableCard');
        if (!card || !isDragging) return;

        currentX = e.touches[0].clientX;
        currentY = e.touches[0].clientY;
        const moveX = currentX - startX;
        let moveY = currentY - startY;

        // 根据 Y 轴的移动量计算旋转角度
        if (moveX < 0) moveY = -moveY;
        const rotation = moveY / 20; // 调整除数来控制旋转敏感度

        if (moveX < -150) {
            cross.style.transform = 'translate(-50%, -50%) scale(1)'
            cross.style.opacity = 1
        } else {
            cross.style.transform = 'translate(-50%, -50%) scale(0)'
            cross.style.opacity = 0
        }

        if (moveX > 150) {
            msg.style.transform = 'translate(-50%, -50%) scale(1)'
            msg.style.opacity = 1
        } else {
            msg.style.transform = 'translate(-50%, -50%) scale(0)'
            msg.style.opacity = 0
        }

        // 应用位移和旋转
        card.style.transform = `translateX(${moveX}px) rotate(${rotation}deg)`;
    });

    document.addEventListener('touchend', function() {
        const card = document.getElementById('draggableCard');
        if (!card || !isDragging) return;

        isDragging = false;
        const moveX = currentX - startX;

        // 判断是否滑动超过150px
        if (moveX > 150) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(100vw)'; // 滑出屏幕右侧
            showMsg()
            window.location.href = 'profile/' + card.dataset.id;
        } else if (moveX < -150) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(-100vw)'; // 滑出屏幕左侧
            showCross()
            setTimeout(next, 300); // 等待动画完成后调用next
        } else {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(0px) rotate(0deg)'; // 回到中间并恢复旋转角度
        }
    });


    function next() {
        // 移除当前可拖拽的卡片
        const currentCard = document.getElementById('draggableCard');
        if (currentCard) {
            currentCard.remove();
        }

        // 调用API获取新数据
        fetch('http://127.0.0.1:8000/getNextUser', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json', // 请求体的内容类型为 JSON
            },
            body: JSON.stringify([]) // 将 JavaScript 对象转换为 JSON 字符串
        }).then(response => response.json())
            .then(data => {
                // 假设API返回的数据格式如下：
                // {
                //     name: 'John Doe',
                //     major: 'Master of AI',
                //     skills: ['Python', 'Machine Learning', 'AI']
                // }

                // 创建新的卡片元素
                const newCard = document.createElement('div');
                newCard.classList.add('card');

                const skillsArray = data.skills.split(';');
                // 生成包含 <span> 标签的 HTML
                const skillsHtml = skillsArray.map(skill => `<span>${skill}</span>`).join('');

                // 添加卡片内容
                newCard.innerHTML = `<div class="photo" style="background: url('images/${data.photo}') center / cover;"></div>
        <div class="info">
            <p class="info-name">${data.name}</p>
            <p class="info-major">${data.major}</p>
            <p class="info-skill">${skillsHtml}</p>
            </div>`;
                newCard.dataset.id = data.id

                // 插入到.card-box容器中
                const cardBox = document.querySelector('.card-box');
                cardBox.appendChild(newCard);

                // 重新调整新卡片的样式，恢复到前景位置
                let frontCard = document.querySelector('.card')
                frontCard.id = "draggableCard"
                frontCard.style.transform = ''
                frontCard.style.zIndex = '2';

                // 调整上一张卡片的位置
                newCard.style.transform = 'scale(0.9) translateY(-50px)';
                newCard.style.zIndex = '1';
            })
            .catch(error => {
                console.error('Error fetching next card data:', error);
            });
    }

    function showCross() {
        cross.style.transform = 'translate(-50%, -50%) scale(1)'
        cross.style.opacity = 1
        setTimeout(function () {
            cross.style.transform = 'translate(-50%, -50%) scale(0)'
            cross.style.opacity = 0
        }, 500)
    }
    function showMsg() {
        msg.style.transform = 'translate(-50%, -50%) scale(1)'
        msg.style.opacity = 1
        setTimeout(function () {
            msg.style.transform = 'translate(-50%, -50%) scale(0)'
            msg.style.opacity = 0
        }, 500)
    }


    document.addEventListener("DOMContentLoaded", function() {
        // 当页面完全加载后隐藏loading screen
        window.onload = function() {
            const loadingScreen = document.getElementById('loading-screen');
            if (loadingScreen) {
                loadingScreen.style.display = 'none';
            }
        };
    });

</script>
</body>
</html>
