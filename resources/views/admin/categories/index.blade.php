@extends('app')
@section('content')
    <div class="container">
        <h3>Catgorias</h3>
        @include('admin._check')
        <p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-default">Nova categoria</a>
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
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><a class="btn btn-default btn-small" href="{{ route('admin.categories.edit',['id'=>$category->id])  }}">Editar</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>
@endsection
