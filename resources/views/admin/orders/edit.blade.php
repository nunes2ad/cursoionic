@extends('app')
@section('content')
    <div class="container">
        <h3>Editando categoria {{ $order->name  }}</h3>

        @include('admin._check')

        {!! Form::model($order, ['route'=> ['admin.orders.update', $order->id]]) !!}

            @include('admin.orders._form')

        {!! Form::close() !!}
    </div>
@endsection
