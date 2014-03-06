@section('content')
<div class="col-lg-4">
    <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;">
    <h2>{{$product->name}}</h2>
    <p>{{$product->description}}</p>
    <p><b>价格:</b>{{$product->price}}</p>
    <p><b>数量:</b>{{$product->stock}}</p>
    <p><b>购物车物品:</b>{{$cart->totalItems()}}</p>

    <div>
        {{ Form::open(array('route' => 'carts.store', 'method' => 'post'))}}
        购买量:{{Form::text('qty', '1')}}
        {{Form::hidden('id',$product->id)}}
        {{Form::submit('加入购物车',array('class'=>'btn btn-default'))}}
    </div>
    <p><a href="{{route('products.index')}}">返回</a></p>
</div>





@stop