@extends('app')
@section('content')
    <div class="container">
        <h3>Novo cliente</h3>

        @include('admin._check')

        {!! Form::open(['route'=>'admin.clients.store', 'class'=>'form']) !!}

            @include('admin.clients._form')

        {!! Form::close() !!}
    </div>
@endsection