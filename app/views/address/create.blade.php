@section('content')

<form class="form" role="form" action="{{route('address.store')}}" method="post">
    <h2 class="form-signin-heading">新地址</h2>
    <input type="text" class="form-control" placeholder="姓名" required autofocus name="name">
    <input type="text" class="form-control" placeholder="联系电话" required autofocus name="phone">
    <input type="text" class="form-control" placeholder="详细地址" required autofocus name="address">
    <input type="text" class="form-control" placeholder="城市" required autofocus name="city">
    <input type="text" class="form-control" placeholder="省" required autofocus name="province">
    <input type="postcode" class="form-control" placeholder="邮编" required autofocus name="postcode">
    <button class="btn btn-lg btn-primary btn-block" type="submit">新建</button>
</form>
@stop