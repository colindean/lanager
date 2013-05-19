@layout('layouts/default')
@section('content')

<h2>{{e($info->title)}}</h2>

@include('info.children')
<br>

{{Sparkdown\Markdown($info->content)}}

@endsection