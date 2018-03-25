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
            <div class="box box-solid">
                @if (count($data) > 0)
                    <div class="box-body table-responsive no-padding">
                        @foreach ($data as $month => $orders)
                            <h1>{{ \Carbon\Carbon::createFromFormat('mY', $month)->formatLocalized('%B %Y') }}<h1>
                            @foreach ($orders as $consumer_orders)
                                <h2>{{ $consumer_orders[0]->order->reference }}</h2>
                                @foreach ($consumer_orders as $consumer_order)
                                    {{ $consumer_order->reference }} <br />
                                @endforeach
                            @endforeach
                        @endforeach
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
