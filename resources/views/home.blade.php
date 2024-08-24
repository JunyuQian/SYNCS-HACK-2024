<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .photo {
            width: 100%;
            height: 450px;
            background: url('{{ asset('images/default_photo.jpeg') }}') center / cover;
            margin: 0 auto;
        }

        .card {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            cursor: grab;
            position: relative;
            touch-action: none; /* 禁用浏览器默认的触摸行为（如滚动） */
            transition: transform 0.3s ease; /* 添加平滑的过渡效果 */
        }

        .card-box {
            width: 80%;
            margin: 0 auto;
            position: relative;
        }

        .info {
            width: 100%;
            text-align: center;
            background: orangered;
            color: white;
            padding: 10px 0;
            font-family: Arial, sans-serif;
        }

        .info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<h1>TalentLink</h1>

<div class="card-box">
    <div class="card" id="draggableCard">
        <div class="photo"></div>
        <div class="info">
            <p>Tommy, 18</p>
            <p>Master of CS</p>
        </div>
    </div>
</div>

<x-tag />

<script>
    const card = document.getElementById('draggableCard');
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    // 触摸开始
    card.addEventListener('touchstart', function(e) {
        isDragging = true;
        startX = e.touches[0].clientX;
        card.style.transition = 'none'; // 禁用过渡效果，用户拖动时体验更好
    });

    // 触摸移动
    card.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        const moveX = currentX - startX;
        card.style.transform = `translateX(${moveX}px)`; // 移动卡片
    });

    // 触摸结束
    card.addEventListener('touchend', function() {
        isDragging = false;
        const moveX = currentX - startX;

        // 判断是否滑动超过100px
        if (moveX > 100) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(100vw)'; // 滑出屏幕右侧
        } else if (moveX < -100) {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(-100vw)'; // 滑出屏幕左侧
        } else {
            card.style.transition = 'transform 0.3s ease';
            card.style.transform = 'translateX(0px)'; // 回到中间
        }
    });
</script>
</body>
</html>
