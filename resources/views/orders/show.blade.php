@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.orders') }}<small>{{ $order->reference }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('orders.index') }}">{{ trans('general.orders') }}</a></li>
            <li class="active">{{ $order->reference }}</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('title.general-information') }}</h3>
                </div>
                <div class="box-body">
                    {{ $order->reference }}
                </div>
            </div>
        </div>
    </div>

@endsection
