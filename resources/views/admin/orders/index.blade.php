@extends('app')
@section('content')
    <div class="container">
        <h3>Catgorias</h3>
        @include('admin._check')
        <p>
            <a href="{{ route('admin.orders.create') }}" class="btn btn-default">Nova categoria</a>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Data</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>

            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>R$ {{ $order->total }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @foreach($order->items as $item)
                            <li>{{$item->product->name}}</li>
                        @endforeach
                    </td>
                    <td>
                        @if($order->deliveryman)
                            {{$order->deliveryman->name}}
                        @else
                            --
                        @endif
                    </td>
                    <td>{{$order->status}}</td>
                    <td><a class="btn btn-default btn-small" href="{{ route('admin.orders.edit',['id'=>$order->id])  }}">Editar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $orders->render() !!}
    </div>
@endsection
