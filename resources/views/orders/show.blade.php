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
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $order->getTotalProductsQuantity() }}</h3>
                    <p>boîtes au total</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>X</h3>
                    <p>cartons</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dropbox"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('title.consumer-orders-list') }}</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('label.consumer') }}</th>
                                <th>Quantité à commander</th>
                                <th>Quantité du stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->consumer_orders as $consumer_order)
                                <tr>
                                    <td>{{ $consumer_order->consumer->full_name }}</td>
                                    <td>{{ $consumer_order->products()->sum('quantity') - $consumer_order->products()->where('from_stock', true)->sum('quantity') }}</td>
                                    <td>{{ $consumer_order->products()->where('from_stock', true)->sum('quantity') }}</td>
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

        <div class="col-md-9 col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ trans('label.product') }}</th>
                            <th>{{ trans('label.category') }}</th>
                            <th>{{ trans('label.quantity') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->product->name }}</td>
                                    <td>{{ $product->product->category->name }}</td>
                                    <td>{{ $product->sum_quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
