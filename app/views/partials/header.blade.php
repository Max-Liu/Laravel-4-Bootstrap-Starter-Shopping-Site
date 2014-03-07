
@if (Auth::check())
    欢迎 {{Auth::user()->username}}!
    <a href="/user/logout">登出</a>
@else
    <a href="/user/login">登陆</a>
@endif
