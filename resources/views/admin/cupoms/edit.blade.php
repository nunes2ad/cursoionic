@extends('app')
@section('content')
    <div class="container">
        <h3>Editando cupom</h3>

        @include('admin._check')

        {!! Form::model($cupom, ['route'=> ['admin.cupoms.update', $cupom->id]]) !!}

            @include('admin.cupoms._form')

        {!! Form::close() !!}
    </div>
@endsection
