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
            background: url('{{ asset('images/default_photo.jpeg') }}') center / cover;
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
            width: 80%;
            margin: 50px auto;
            position: relative;
        }

        .info {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            color: white;
            padding: 10px;
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
            text-align: center;
            box-sizing: border-box;
        }
        #cross img{
            width: 120px;
            height: 120px;
            color: white;
        }
        #cross.show, #msg.show {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
            z-index: 999;
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
        }
        #msg img{
            width: 140px;
            height: 140px;
        }


    </style>
</head>
<body>
<h1>TalentLink</h1>

<div class="card-box">
    <div class="card">
        <div class="photo"></div>
        <div class="info">
            <p class="info-name">Tommy</p>
            <p class="info-major">Master of Computer Science</p>
            <p class="info-skill"><span>Python</span><span>JavaScript</span><span>C++</span></p>
        </div>
    </div>
    <div class="card">
        <div class="photo"></div>
        <div class="info">
            <p class="info-name">Tommy</p>
            <p class="info-major">Master of Computer Science</p>
            <p class="info-skill"><span>Python</span><span>JavaScript</span><span>C++</span></p>
        </div>
    </div>
</div>
<div class="love"></div>
<div id="cross" class=""><img src="{{ asset('svg/cross.svg') }}" alt=""></div>
<div id="msg" class=""><img src="{{ asset('chat.svg') }}" alt=""></div>
<x-tag />

<script>
    const card = document.getElementById('draggableCard');
    const cross = document.getElementById('cross');
    const msg = document.getElementById('msg');
    let startX = 0;
    let startY = 0;
    let currentX = 0;
    let currentY = 0;
    let isDragging = false;

    // 触摸开始
    card.addEventListener('touchstart', function(e) {
        isDragging = true;
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
        card.style.transition = 'none'; // 禁用过渡效果，用户拖动时体验更好
    });

    // 触摸移动
    card.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        currentY = e.touches[0].clientY;
        const moveX = currentX - startX;
        let moveY = currentY - startY;

        // 根据 Y 轴的移动量计算旋转角度
        if (moveX < 0) moveY = -moveY
        const rotation = moveY / 20; // 调整除数来控制旋转敏感度

        if (moveX < -150) {
            cross.classList.add('show')
        } else{
            // 延迟移除类名，确保过渡动画有时间播放
            setTimeout(() => {
                cross.classList.remove('show');
            }, 10); // 可以根据需要调整延迟时间
        }

        if (moveX > 150) {
            msg.classList.add('show')
        } else{
            // 延迟移除类名，确保过渡动画有时间播放
            setTimeout(() => {
                msg.classList.remove('show');
            }, 10); // 可以根据需要调整延迟时间
        }

        // 应用位移和旋转
        card.style.transform = `translateX(${moveX}px) rotate(${rotation}deg)`;
    });

    // 触摸结束
    card.addEventListener('touchend', function() {
        isDragging = false;
        const moveX = currentX - startX;

        // 判断是否滑动超过150px
        if (moveX > 150) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(100vw)'; // 滑出屏幕右侧
        } else if (moveX < -150) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(-100vw)'; // 滑出屏幕左侧
        } else {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(0px) rotate(0deg)'; // 回到中间并恢复旋转角度
        }

        // 延迟移除类名，确保过渡动画有时间播放
        setTimeout(() => {
            cross.classList.remove('show');
            msg.classList.remove('show');
        }, 10); // 可以根据需要调整延迟时间
    });
</script>
</body>
</html>
