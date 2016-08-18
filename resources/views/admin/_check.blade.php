@if($errors->any())
    <ul class="alert">
        @foreach($errors->all() as $error)
            <li>{{ $error  }}</li>
        @endforeach
    </ul>
@endif
<div class="flash-message">
    @if(Session::has('message'))
        <div class="alert alert-{{ session('type') }}">{!! session('message') !!}</div>
    @endif
</div>