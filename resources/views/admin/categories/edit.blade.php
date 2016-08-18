@extends('app')
@section('content')
    <div class="container">
        <h3>Editando categoria {{ $category->name  }}</h3>

        @include('admin._check')

        {!! Form::model($category, ['route'=> ['admin.categories.update', $category->id]]) !!}

            @include('admin.categories._form')

        {!! Form::close() !!}
    </div>
@endsection
