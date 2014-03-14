@section('content')
1231

{{Form::open(array('url' => route('images.store'), 'files' => true))}}
{{Form::file('image');}}
{{Form::submit('Click Me!')}}

@stop