@section('content')
<div class="row">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h2 class="sub-header">购物车</h2><a href="{{route('products.index')}}">商品列表</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>名称</th>
                    <th>价格</th>
                    <th>数量</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($carts as $key=>$cart)
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
            <div>
                {{Form::open(array('route' => array('carts.destroy','destroy'),'method'=>'DELETE'))}}
                {{Form::submit('清空购物车',array('class'=>'btn btn-default'))}}
                {{ Form::close() }}
            </div>
            <p>总量:{{$totalItems}}</p>
            <p>总价:{{$totalPrice}}</p>
        </div>
    </div>
</div>
@stop

