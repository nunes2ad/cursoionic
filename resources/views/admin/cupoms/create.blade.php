@extends('app')
@section('content')
    <div class="container">
        <h3>Nova cupom</h3>

        @include('admin._check')

        {!! Form::open(['route'=>'admin.cupoms.store', 'class'=>'form']) !!}

            @include('admin.cupoms._form')

        {!! Form::close() !!}
    </div>
@endsection