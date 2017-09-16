@extends('backpack::layout')

@section('content')

    @if ($order->consumer_orders->isNotEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ $order->reference }}</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            @include('orders.show-boxes-table')
                            @include('orders.show-candidates-table')
                        </div>
                        <div class="col-md-6 col-xs-12">
                            @include('orders.show-figures')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('title.consumer-orders-list') }}</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('orders.show-table')
                </div>
                <div class="box-footer">
                    {{ link_to_route('consumer_orders.create', trans('actions.new'), ['order_id' => $order->id], ['class' => 'btn btn-primary pull-left']) }}
                </div>
            </div>
        </div>
    </div>
    @else
        @include('orders.show-empty')
    @endif

@endsection
