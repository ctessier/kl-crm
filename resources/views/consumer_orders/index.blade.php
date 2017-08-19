@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers-orders') }}
        </h1>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if ($consumer_orders->count() > 0)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('label.reference') }}</th>
                                <th>{{ trans('label.lastname') }}</th>
                                <th>{{ trans('label.firstname') }}</th>
                                <th>{{ trans('label.month') }}</th>
                                <th>{{ trans('label.is-test-program') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($consumer_orders as $consumer_order)
                                <tr>
                                    <td>{{ $consumer_order->reference }}</td>
                                    <td>{{ $consumer_order->consumer->last_name }}</td>
                                    <td>{{ $consumer_order->consumer->first_name }}</td>
                                    <td>{{ $consumer_order->month->formatLocalized('%B %Y') }}</td>
                                    <td>{{ trans('general.'.($consumer_order->is_test_program ? 'yes' : 'no')) }}</td>
                                    <td>
                                        {!! link_to_route('consumer_orders.show', trans('actions.edit'), ['consumer_order' => $consumer_order], ['class' => 'btn btn-xs btn-default']) !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="box-body">
                        {{ trans('messages.no-consumers') }}
                    </div>
                @endif
                <div class="box-footer">
                    {!! link_to_route('consumer_orders.create', trans('actions.new'), [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
