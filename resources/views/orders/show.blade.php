@extends('backpack::layout')

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
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('title.consumer-orders-list') }}</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('label.consumer') }}</th>
                                @foreach ($order->products as $product)
                                <th>{{ $product->product->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->consumer_orders as $consumer_order)
                                <tr>
                                    <td>
                                        {{ $consumer_order->consumer->full_name }}
                                        {{ link_to_route('consumer_orders.show', trans('actions.view'), $consumer_order->id, ['class' => 'btn btn-xs btn-default']) }}
                                    </td>
                                    @foreach ($order->products as $order_consumer_order)
                                    <td>{{ $consumer_order->getProductQuantity($order_consumer_order->product) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            @foreach ($order->products as $consumer_order)
                                <th>{{ $order->getTotalByProduct($consumer_order->product) }}</th>
                            @endforeach
                        </tfoot>
                    </table>
                </div>
                <div class="box-footer">
                    {{ link_to_route('consumer_orders.create', trans('actions.new'), [], ['class' => 'btn btn-primary pull-left']) }}
                </div>
            </div>
        </div>
    </div>

@endsection
