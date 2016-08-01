@extends('app')
@section('content')
    <div class="container">
        <h2>Pedido #{{ $order->id  }}</h2>
        <h3>Cliente: {{ $order->client->user->name  }}</h3>
        <h4>Data: {{ $order->created_at  }}</h4>
        <p>
            Entregar em:<br>
            {{ $order->client->address }} - {{ $order->client->city }} / {{ $order->client->state }}
        </p>

        @include('admin._check')

        {!! Form::model($order, ['route'=> ['admin.orders.update', $order->id]]) !!}

            @include('admin.orders._form')

        {!! Form::close() !!}
    </div>
@endsection
