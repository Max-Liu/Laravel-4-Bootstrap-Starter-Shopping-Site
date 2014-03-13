@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header">我的地址</h2>
    <div class="table-responsive">
        <p><a href="{{route('address.create')}}">新建地址</a></p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>收件人</th>
                <th>联系电话</th>
                <th>详细地址</th>
                <th>城市</th>
                <th>邮编</th>
                <th>省</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($addressList as $address)
            <tr>
                <td>{{$address->id}}</td>
                <td>{{$address->name}}</td>
                <td>{{$address->phone}}</td>
                <td>{{$address->address}}</td>
                <td>{{$address->city}}</td>
                <td>{{$address->postcode}}</td>
                <td>{{$address->province}}</td>
                <td>
                    <a class="btn btn-default" href="{{route('address.edit',$address->id)}}">编辑</a>
                    {{Form::open(array('url' =>route('address.destroy',$address->id), 'method' => 'delete'))}}
                    {{Form::submit('删除',array('class'=>'btn btn-default'))}}
                    {{Form::close()}}
                    <a class="btn btn-default" href="{{url('address/default',$address->id)}}">设为默认</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$addressList->links()}}
</div>


@stop