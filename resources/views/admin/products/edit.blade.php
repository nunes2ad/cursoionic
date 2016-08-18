@extends('app')
@section('content')
    <div class="container">
        <h3>Editando produto {{ $product->name  }}</h3>

        @include('admin._check')

        {!! Form::model($product, ['route'=> ['admin.products.update', $product->id]]) !!}

            @include('admin.products._form')

        {!! Form::close() !!}
    </div>
@endsection
