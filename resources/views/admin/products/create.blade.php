@extends('app')
@section('content')
    <div class="container">
        <h3>Nova catgoria</h3>

        @include('admin._check')

        {!! Form::open(['route'=>'admin.products.store', 'class'=>'form']) !!}

            @include('admin.products._form')

        {!! Form::close() !!}
    </div>
@endsection