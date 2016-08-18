@extends('app')
@section('content')
    <div class="container">
        <h3>Nova catgoria</h3>

        @include('admin._check')

        {!! Form::open(['route'=>'admin.categories.store', 'class'=>'form']) !!}

            @include('admin.categories._form')

        {!! Form::close() !!}
    </div>
@endsection