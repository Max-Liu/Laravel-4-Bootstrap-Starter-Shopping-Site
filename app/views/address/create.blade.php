@section('content')
<form class="form" role="form" action="{{route('addresses.store')}}" method="post">
    <h2 class="form-signin-heading">新地址</h2>
    <input type="text" class="form-control" placeholder="姓名" required autofocus name="name" value="{{Session::get('data')['name']}}">
    <input type="text" class="form-control" placeholder="联系电话" required autofocus name="phone" value="{{Session::get('data')['phone']}}">
    <input type="text" class="form-control" placeholder="详细地址" required autofocus name="address" value="{{Session::get('data')['address']}}">
    <input type="text" class="form-control" placeholder="城市" required autofocus name="city" value="{{Session::get('data')['city']}}">
    <input type="text" class="form-control" placeholder="省" required autofocus name="province" value="{{Session::get('data')['province']}}">
    <input type="postcode" class="form-control" placeholder="邮编" required autofocus name="postcode" value="{{Session::get('data')['postcode']}}">
    <button class="btn btn-lg btn-primary btn-block" type="submit">新建</button>
</form>
@stop