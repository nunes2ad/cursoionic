@extends('app')
@section('content')
    <div class="container">
        <h3>Produtos</h3>
        @include('admin._check')
        <p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-default">Novo Produto</a>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price,2) }}</td>
                    <td class="right">
                        <a class="btn btn-default btn-small" href="{{ route('admin.products.edit',['id'=>$product->id])  }}">Editar</a>
                        <a class="btn btn-default btn-small" href="{{ route('admin.products.destroy',['id'=>$product->id])  }}">Apagar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>
@endsection
