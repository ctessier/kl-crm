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
            <p>
                {!! Form::open(['route' => ['orders.store'], 'method' => 'post', 'class' => 'inline']) !!}
                {!! Form::submit(trans('actions.new'), ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </p>
            @if (count($data) > 0)
                @foreach ($data as $month => $orders)
                    <h2 data-toggle="collapse" href="#month-{{ $loop->index }}" class="collapsed">
                        {{ ucfirst(\Carbon\Carbon::createFromFormat('Ym', $month)->formatLocalized('%B %Y')) }}
                        <small>X Cartons</small>
                    </h2>
                    <div id="month-{{ $loop->index }}" class="collapse">
                        <div class="box-group" id="group-{{ $loop->index }}">
                            @foreach ($orders as $consumer_orders)
                                <div class="panel box order-{{ ($loop->index % 3) + 1 }}">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            <a data-toggle="collapse" data-parent="#group-{{ $loop->parent->index }}" href="#order-{{ $loop->parent->index.'-'.$loop->index }}" aria-expanded="false" class="collapsed">
                                                {{ $consumer_orders[0]->order->reference }}
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="order-{{ $loop->parent->index.'-'.$loop->index }}" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="box-body">
                                            @foreach ($consumer_orders as $consumer_order)
                                                {{ $consumer_order->consumer ?? 'Avenant' }}<br />
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <p>{{ trans('messages.no-orders') }}</p>
            @endif
        </div>
    </div>
@endsection
