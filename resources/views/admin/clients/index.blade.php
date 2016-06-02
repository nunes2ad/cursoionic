@extends('app')
@section('content')
    <div class="container">
        <h3>Clientes</h3>
        @include('admin._check')
        <p>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-default">Novo Cliente</a>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>
                        <a class="btn btn-default btn-small" href="{{ route('admin.clients.edit',['id'=>$client->id])  }}">Editar</a>
                        <a class="btn btn-default btn-small" href="{{ route('admin.clients.destroy',['id'=>$client->id])  }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}
    </div>
@endsection
