@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.orders') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('general.orders') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if ($orders->count() > 0)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ trans('label.reference') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->reference }}</td>
                                    <td>
                                        {!! link_to_route('orders.show', trans('actions.view'), ['orders' => $order], ['class' => 'btn btn-xs btn-default']) !!}
                                        {!! Form::open(['route' => ['orders.destroy', $order], 'method' => 'delete', 'class' => 'inline']) !!}
                                        {!! Form::submit(trans('actions.delete'), ['class' => 'btn btn-xs btn-danger', 'data-delete' => trans('messages.order-delete-confirm')]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="box-body">
                        {{ trans('messages.no-orders') }}
                    </div>
                @endif
                <div class="box-footer">
                    {!! Form::open(['route' => ['orders.store'], 'method' => 'post', 'class' => 'inline']) !!}
                    {!! Form::submit(trans('actions.new'), ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
