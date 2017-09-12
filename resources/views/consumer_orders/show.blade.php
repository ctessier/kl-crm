@extends('backpack::layout')

@section('content')

    <div class="row">
        <div class="col-md-6 col-sm-12">
            {!! Form::model($consumer_order, ['route' => ['consumer_orders.update', $consumer_order], 'method' => 'put']) !!}
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('title.general-information') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('elements.forms.consumer_orders.general-information')
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('actions.save'), ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('title.products') }}</h3>
                </div>

                @if ($consumer_order->products->count() > 0)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('label.product') }}</th>
                                <th>{{ trans('label.quantity') }}</th>
                                <th>{{ trans('label.stock') }}</th></h>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($consumer_order->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->pivot->from_stock ? trans('general.yes') : trans('general.no') }}</td>
                                    <td>
                                        {!! link_to_route('consumer_orders.products.edit', trans('actions.edit'), ['consumer_order' => $consumer_order, 'product' => $product], ['class' => 'btn btn-xs btn-default']) !!}
                                        {!! Form::open(['route' => ['consumer_orders.products.destroy', $consumer_order, $product], 'method' => 'delete', 'class' => 'inline']) !!}
                                            {!! Form::submit(trans('actions.delete'), ['class' => 'btn btn-xs btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="box-body">
                        <p>{{ trans('messages.no-products') }}</p>
                    </div>
                @endif

                <div class="box-footer">
                    {!! Form::open(['route' => ['consumer_orders.products.store', $consumer_order], 'method' => 'post']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                {{ Form::select('product_id', $products, null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::selectRange('quantity', 1, config('krisslaure.stock-range-max'), null, ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-2">
                                <div class="checkbox">
                                    <label for="from_stock">
                                        {{ Form::checkbox('from_stock', true, null, ['id' => 'from_stock']) }}
                                        {{ trans('label.from_stock') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                {{ Form::submit(trans('actions.add'), ['class' => 'btn btn-primary pull-right']) }}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
