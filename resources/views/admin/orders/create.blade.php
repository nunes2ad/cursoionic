@extends('app')
@section('content')
    <div class="container">
        <h3>Novo pedido</h3>

        @include('admin._check')

        {!! Form::open(['route'=>'admin.orders.store', 'class'=>'form']) !!}

            @include('admin.orders._form')

        {!! Form::close() !!}
    </div>
@endsection