@section('content')

@foreach($errors->all('<li>:message</li>') as $message)
{{$message}}
@endforeach
<form class="form-signin" role="form" action="{{route('addresses.update',$address->id)}}" method="post">
    <h2 class="form-signin-heading">修改</h2>
    <input type="text" class="form-control" placeholder="姓名" required autofocus name="name" value="{{$address->name}}">
    <input type="text" class="form-control" placeholder="联系电话" required autofocus name="phone" value="{{$address->phone}}">
    <input type="text" class="form-control" placeholder="详细地址" required autofocus name="address" value="{{$address->address}}">
    <input type="text" class="form-control" placeholder="城市" required autofocus name="city" value="{{$address->city}}">
    <input type="text" class="form-control" placeholder="省" required autofocus name="province" value="{{$address->province}}">
    <input type="postcode" class="form-control" placeholder="邮编" required autofocus name="postcode" value="{{$address->postcode}}">
    <input name="_method" type="hidden" value="put" />
    <button class="btn btn-lg btn-primary btn-block" type="submit">修改</button>
</form>
@stop