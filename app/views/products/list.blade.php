@section('content')
<div class="row">
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h2 class="sub-header">product</h2>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
				<tr>
					<th>id</th>
                    <th>名称</th>
					<th>价格</th>
					<th>数量</th>
					<th>状态</th>
					<th>类别</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($products as $product)
				<tr>
					<td>{{$product->id}}</td>
                    <td><a href="{{route('products.show',$product->id)}}">{{$product->name}}</a></td>
					<td>{{$product->price}}</td>
					<td>{{$product->stock}}</td>
					<td>{{$product->status}}</td>
                    @if($product->category)
					<td>{{$product->category->name}}</td>
                    @endif
				</tr>
				@endforeach
				</tbody>
			</table>
            {{$products->links()}}
		</div>
	</div>
</div>
@stop

