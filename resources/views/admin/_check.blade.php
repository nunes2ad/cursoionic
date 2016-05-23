@if($errors->any())
    <ul class="alert">
        @foreach($errors->all() as $error)
            <li>{{ $error  }}</li>
        @endforeach
    </ul>
@endif
<div class="flash-message">
    @foreach(['success','warning','alert','error'] as $flag)
        @if(Session::has($flag))
            <div class="alert alert-success">{!! session($flag) !!}</div>
        @endif
    @endforeach
</div>