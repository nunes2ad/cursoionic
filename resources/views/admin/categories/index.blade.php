@extends('app')
@section('content')
    <div class="content">
        <h3>Catgorias</h3>
        <p>
            <a href="{{ route('admin.category.create') }}" class="btn btn-default">Nova categoria</a>
        </p>
        <table class="table table-responsive">
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
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>
@endsection
