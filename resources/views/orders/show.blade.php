@extends('backpack::layout')

@section('content')

    @include('orders.show-general-information')

    @include('orders.show-figures')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('title.consumer-orders-list') }}</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    @include('orders.show-table')
                </div>
                <div class="box-footer">
                    {{ link_to_route('consumer_orders.create', trans('actions.new'), [], ['class' => 'btn btn-primary pull-left']) }}
                </div>
            </div>
        </div>
    </div>

@endsection
