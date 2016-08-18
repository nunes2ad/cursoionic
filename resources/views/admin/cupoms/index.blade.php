@extends('app')
@section('content')
    <div class="container">
        <h3>Cupons</h3>
        @include('admin._check')
        <p>
            <a href="{{ route('admin.cupoms.create') }}" class="btn btn-default">Novo cupom</a>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
                <tr>
                    <td>{{ $cupom->id }}</td>
                    <td>{{ $cupom->code }}</td>
                    <td>{{ $cupom->value }}</td>
                    <td>{{ $cupom->used }}</td>
                    <td>
                        <a class="btn btn-default btn-small" href="{{ route('admin.cupoms.edit',['id'=>$cupom->id])  }}">Editar</a>
                        <a class="btn btn-default btn-small" href="{{ route('admin.cupoms.destroy',['id'=>$cupom->id])  }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $cupoms->render() !!}
    </div>
@endsection
