@section('content')
<div class="row">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">我的订单</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th>状态</th>
                    <th>总价</th>
                    <th>送货地址</th>
                    <th>下单时间</th>
                    <th>详情</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)

                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order::getOrderStatusStr($order->status)}}</td>
                    <td>{{$order->price_total}}</td>
                    <td>
                        @if ($order->address)
                            {{$order->address->name}}
                        @endif
                    </td>

                    <td>{{$order->created_at}}</td>
                    <td><a href="{{route('orders.show',$order->id)}}">详情</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

