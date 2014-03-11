@section('content')

<h2 class="sub-header">订单详情</h2>


<p>下单时间：{{$order->created_at}}</p>
<p>总价：{{$order->price_total}}</p>
<p>状态：{{Order::getOrderStatusStr($order->status)}}</p>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>产品id</th>
            <th>产品名称</th>
            <th>产品价格</th>
            <th>购买数量</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orderItems as $item)
        <tr>
            <td>{{$item->product_id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->qty}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>

@stop
