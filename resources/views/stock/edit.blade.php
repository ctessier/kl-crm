@extends('layouts.app')

@section('header', 'Mon stock')

@section('content')

    {!! Form::open(['route' => 'stock.update', 'method' => 'post', 'role' => 'form']) !!}
        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-default']) !!}

        @foreach (\App\Categories::all() as $category)
            @include('elements.stock-category')
        @endforeach

    {!! Form::close() !!}

@endsection
