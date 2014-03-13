@section('content')

<div>
    <h2>地址</h2>
    <p>默认地址：{{$address->name}} {{$address->address}}</p>
</div>

<div class="table-responsive">
    <h2>商品详情</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>名称</th>
            <th>价格</th>
            <th>数量</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cartList as $key=>$cart)
        <tr>
            <td><a href="{{route('products.show',$cart['id'])}}">{{$cart['name']}}</a></td>
            <td>{{$cart['price']}}</td>
            <td>{{$cart['qty']}}</td>
            <td>
                {{Form::open(array('route' => array('carts.destroy', $key),'method'=>'DELETE'))}}
                {{Form::submit('删除',array('class'=>'btn btn-default'))}}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <p>总量:{{$totalItems}}</p>
    <p>总价:{{$totalPrice}}</p>
</div>




{{Form::open(array('route' => array('orders.store'),'method'=>'POST'))}}
{{Form::hidden('ship_to', $address->id);}}
{{Form::submit('下单',array('class'=>'btn btn-default'))}}
{{ Form::close() }}
@stop