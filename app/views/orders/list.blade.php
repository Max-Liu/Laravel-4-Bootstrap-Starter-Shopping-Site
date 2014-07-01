@section('content')
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
                @foreach ($dataObjects as $data)
                <tr>

                    <td>{{$data->id}}</td>
                    <td>{{$order->getOrderStatusStr($data->status)}}</td>
                    <td>{{$data->price_total}}</td>
                    <td>
                        @if ($data->address)
                            {{$data->address->name}}
                            {{$data->address->phone}}
	                        {{$data->address->address}}
                        @endif
                    </td>

                    <td>{{$data->created_at}}</td>
                    <td><a href="{{route('orders.show',$data->id)}}">详情</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@stop

