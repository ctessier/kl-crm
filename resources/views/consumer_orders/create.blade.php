@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers-orders') }}<small>{{ trans('general.new.feminine') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('consumer_orders.index') }}">{{ trans('general.consumers-orders') }}</a></li>
            <li class="active">{{ trans('general.new.feminine') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    {!! Form::open(['route' => 'consumer_orders.store', 'method' => 'post']) !!}

        <div class="row">
            <div class="col-lg-4 col-md-8 col-lg-offset-4 col-md-offset-2">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('title.general-information') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('elements.forms.consumer_orders.general-information')
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('actions.continue'), ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}

@endsection
