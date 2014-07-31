<ul class="nav navbar-nav">
    <li class="active"><a href="#">Home</a></li>
    <li><a href="/products">商品列表</a></li>
    <li><a href="/carts">我的购物车</a></li>
    <li><a href="/orders">我的订单</a></li>
    <li><a href="/addresses">我的地址</a></li>
    @if (Auth::check())
    <li><a href="/user/logout">欢迎 {{Auth::user()->username}}! 登出</a></li>
    @else
    <li><a href="/user/login">登陆</a></li>
    @endif

	@if(Auth::user()->group_id == 1)
	<li><a href="/permissions">权限管理</a></li>
	<li><a href="/tags">标签管理</a></li>
	@endif
</ul>

