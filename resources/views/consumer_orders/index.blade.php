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
            <div class="box box-solid">
                @if ($consumer_orders->count() > 0)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('label.reference') }}</th>
                                <th>{{ trans('label.consumer') }}</th>
                                <th>{{ trans('label.month') }}</th>
                                <th>{{ trans('label.is-test-program') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($consumer_orders as $consumer_order)
                                <tr>
                                    <td>{{ $consumer_order->reference }}</td>
                                    <td>{{ $consumer_order->consumer->full_name }}</td>
                                    <td>{{ ucfirst($consumer_order->month->formatLocalized('%B %Y')) }}</td>
                                    <td>
                                        @if ($consumer_order->is_test_program)
                                            <i class="fa fa-check"></i>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        {!! link_to_route('consumer_orders.show', trans('actions.edit'), ['consumer_order' => $consumer_order], ['class' => 'btn btn-xs btn-default']) !!}
                                        {!! Form::open(['route' => ['consumer_orders.destroy', $consumer_order], 'method' => 'delete', 'class' => 'inline']) !!}
                                            {!! Form::submit(trans('actions.delete'), ['class' => 'btn btn-xs btn-danger', 'data-delete' => trans('messages.consumer-order-delete-confirm')]) !!}
                                        {!! Form::close() !!}
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
                    {!! link_to_route('consumer_orders.create', trans('actions.new'), [], ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
