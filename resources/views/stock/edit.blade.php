@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('krisslaure.stock') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('krisslaure.stock') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    {!! Form::open(['route' => 'stock.update', 'method' => 'post', 'role' => 'form']) !!}
        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-default']) !!}

        @foreach ($categories as $category)
            @include('elements.stock-category')
        @endforeach

    {!! Form::close() !!}

@endsection
