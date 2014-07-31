@section('content')
		<h2 class="sub-header">标签</h2>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
				<tr>
					<th>id</th>
                    <th>名称</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($tags as $tag)
				<tr>
					<td>{{$tag->id}}</td>
                    <td><a href="{{route('tags.show',$tag->id)}}">{{$tag->name}}</a></td>
				</tr>
				@endforeach
				</tbody>
			</table>
		</div>
@stop

