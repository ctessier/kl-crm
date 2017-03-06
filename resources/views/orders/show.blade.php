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
        <div class="col-md-12">
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

    <div class="row">
        <div class="col-md-4 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('title.consumer-orders-list') }}</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('label.consumer') }}</th>
                                <th>Stock ?</th>
                                <th>Nombre de boîte</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->consumer_orders as $consumer_order)
                                <tr>
                                    <td>{{ $consumer_order->consumer->full_name }}</td>
                                    <td></td>
                                    <td>{{ $consumer_order->products()->sum('quantity') }}</td>
                                    <td>
                                        {{ link_to_route('consumer_orders.show', trans('actions.view'), $consumer_order->id, ['class' => 'btn btn-xs btn-default']) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ link_to_route('consumer_orders.create', trans('actions.new'), [], ['class' => 'btn btn-primary pull-left']) }}
                </div>
            </div>
        </div>
    </div>

@endsection
