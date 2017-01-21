@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers-orders') }}<small>{{ trans('title.new.feminine') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('consumer_orders.index') }}">{{ trans('general.consumers-orders') }}</a></li>
            <li class="active">{{ trans('title.new.feminine') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    {!! Form::model($consumer_orders_product, ['route' => ['consumer_orders.products.update', $consumer_orders_product->consumer_order, $consumer_orders_product->product], 'method' => 'put']) !!}

    <div class="row">
        <div class="col-lg-4 col-md-8 col-lg-offset-4 col-md-offset-2">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">title here</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            {{ Form::select('product_id', $products, null, ['class' => 'form-control']) }}
                        </div>
                        <div class="col-md-4">
                            {{ Form::selectRange('quantity', 1, config('krisslaure.stock-range-max'), null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! Form::submit(trans('actions.save'), ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
