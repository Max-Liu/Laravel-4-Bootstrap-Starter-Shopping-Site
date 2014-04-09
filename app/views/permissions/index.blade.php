@section('content')
<h2 class="sub-header">权限管理</h2>
<p>用户分组</p>
@foreach($groupList as $group)
<a href="{{route('permissions.index').'?group='.$group->id}}">{{$group->name}}</a>
@endforeach

<div class="table-responsive">
<!--	<p><a href="{{route('permissions.create')}}">新建地址</a></p>-->
	<table class="table table-striped">
		<thead>
		<tr>
			<th>id</th>
			<th>分组</th>
			<th>模块</th>
			<th>权限</th>
		</tr>
		</thead>
		<tbody>
		@foreach ($permissionList as $permission)
		<tr>
			<td>{{$permission->id}}</td>
			<td>{{$permission->group->name}}</td>
			<td>{{$permission->module}}</td>
			<td>
			@foreach (unserialize($permission->roles) as $key =>$role)

				<form class="form-signin" role="form" action="{{route('permissions.update',$permission->id)}}" method="post">
					{{$key}}
					@if($role ==1)
					{{Form::checkbox($key,1 ,true)}}
					@else
					{{Form::checkbox($key,1)}}
					@endif
					<input name="_method" type="hidden" value="put" />
					<input name="module" type="hidden" value="{{$permission->module}}" />
					<input name="group" type="hidden" value="{{$permission->group_id}}" />
			@endforeach
					<button class="" type="submit">修改</button>
				</form>
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
@stop