@section('content')
{{Form::open(array('url'=>route('products.update',$product->id),'method'=>'put'))}}

<input name="name" type="text" value="{{$product->name}}">
<input type="text" name="price" value="{{$product->price}}"/>
<input type="text" name="status" value="{{$product::getStatusString($product->status)}}"/>
<input type="text" name="stock" value="{{$product->stock}}"/>
<input type="text" name="description" value="{{$product->description}}"/>
{{Form::submit('修改')}}
{{Form::close()}}

{{Form::open(array('route' =>['images.store'], 'files' => true,'method'=>'post'))}}
{{Form::file('image');}}
<input type="hidden" name="parent_id" value="{{$product->id}}"/>
{{Form::submit('Click Me!')}}
{{Form::close()}}

<div class="col-lg-4">
    @foreach ($product->images as $image)
        {{Form::open(array('url'=>route('images.update',$image->id),'method'=>'put','files'=>true))}}
            <img class="img-circle" data-src="holder.js/140x140" alt="140x140" src="{{$image->path}}" style="width: 140px; height: 140px;">
            <input name="image" type="file">
            <input type="hidden" name="parent_id" value="{{$product->id}}"/>
            <input type="hidden" name="id" value="{{$image->id}}"/>
        {{Form::submit('修改')}}

        {{Form::open(array('url'=>route('images.destroy',$image->id),'method'=>'delete'))}}
        <input type="hidden" name="id" value="{{$image->id}}"/>
        <input type="hidden" name="parent_id" value="{{$product->id}}"/>
        {{Form::submit('删除')}}

        {{Form::close()}}
    @endforeach

</div>
@stop
