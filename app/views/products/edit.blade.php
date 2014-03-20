@section('content')

@foreach ($product->images as $image)

{{Form::open(array('url'=>route('images.update',$image->id),'method'=>'put','files'=>true,'class'=>'.col-xs-6'))}}
<img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="{{$image->path}}"
     style="width: 140px; height: 140px;">
<input name="image" type="file">
<input type="hidden" name="parent_id" value="{{$product->id}}"/>
<input type="hidden" name="id" value="{{$image->id}}"/>
{{Form::submit('修改')}}
{{Form::close()}}

{{Form::open(array('url'=>route('images.destroy',$image->id),'method'=>'delete'))}}
<input type="hidden" name="id" value="{{$image->id}}"/>
<input type="hidden" name="parent_id" value="{{$product->id}}"/>
{{Form::submit('删除')}}
{{Form::close()}}
@endforeach

{{Form::open(array('url'=>route('products.update',$product->id),'method'=>'put','class'=>'form'))}}

<input name="name" type="text" value="{{$product->name}}" class="form-control">
<input type="text" name="price" value="{{$product->price}}" class="form-control"/>
<input type="text" name="status" value="{{$product::getStatusString($product->status)}}" class="form-control"/>
<input type="text" name="stock" value="{{$product->stock}}" class="form-control"/>
<input type="text" name="description" value="{{$product->description}}" class="form-control"/>
<button class="btn btn-lg btn-primary btn-block" type="submit">修改</button>
{{Form::close()}}

{{Form::open(array('route' =>['images.store'], 'files' => true,'method'=>'post'))}}
{{Form::file('image')}}
<input type="hidden" name="id" value="{{$product->id}}"/>
<button class="btn btn-primary" type="submit">上传</button>
{{Form::close()}}
@stop
