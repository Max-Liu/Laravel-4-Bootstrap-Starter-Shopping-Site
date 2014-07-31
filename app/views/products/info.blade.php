@section('content')
<div class="col-lg-4">

@if($product->images)
    @foreach ($product->images as $image)
    <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="{{$image->path}}" style="width: 140px; height: 140px;">
    @endforeach
@endif
    <h2>{{$product->name}}</h2>
    <p>{{$product->description}}</p>
    <p><b>价格:</b>{{$product->price}}</p>
    <p><b>数量:</b>{{$product->stock}}</p>
	<p>标签:
@foreach($tags as $tag)
	<a href="{{route('tags.show',$tag->id)}}">{{$tag->name}}</a>
@endforeach
	</p>

    <div>
        {{ Form::open(array('route' => 'carts.store', 'method' => 'post'))}}
        购买量:{{Form::text('qty', '1')}}
        {{Form::hidden('id',$product->id)}}
        {{Form::submit('加入购物车',array('class'=>'btn btn-default'))}}
    </div>
    <p><a href="{{route('products.index')}}">返回</a></p>
</div>





@stop