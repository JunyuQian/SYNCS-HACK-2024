<div class="bottom-nav">
    <a href="{{ route('home') }}" class="nav-item">
        <img src="/images/home_icon.png" alt="Home" class="nav-icon">
        <span class="nav-label">Home</span>
    </a>
    <a href="{{ route('msg') }}" class="nav-item">
        <img src="/images/notifications_icon.png" alt="Notifications" class="nav-icon">
        <span class="nav-label">Messages</span>
    </a>
    <a href="{{ route('profile') }}" class="nav-item">
        <img src="/images/profile_icon.png" alt="Profile" class="nav-icon">
        <span class="nav-label">Profile</span>
    </a>
</div>

<style>
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-around;
        padding: 10px 0;
    }
    .nav-item {
        text-align: center;
        flex-grow: 1;
        text-decoration: none;
        color: #333;
    }
    .nav-icon {
        width: 24px;
        height: 24px;
    }
    .nav-label {
        display: block;
        margin-top: 5px;
        font-size: 12px;
    }
</style>
