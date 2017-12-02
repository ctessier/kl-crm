@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers') }}<small>{{ trans('general.new.masculine') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('consumers.index') }}">{{ trans('general.consumers') }}</a></li>
            <li class="active">{{ trans('general.new.masculine') }}</li>
        </ol>
    </section>
@endsection

@section('content')

    {!! Form::open(['route' => 'consumers.store', 'method' => 'post']) !!}

        <div class="row">

            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('title.personal-information') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('elements.forms.consumers.personal-information')
                    </div>
                </div>
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('label.consumer-status') }} {{ config('backpack.base.project_name') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('elements.forms.consumers.status')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">{{ trans('title.contact-details') }}</h3>
                    </div>
                    <div class="box-body">
                        @include('elements.forms.consumers.contact-details')
                    </div>
                </div>
                {!! Form::submit(trans('actions.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        </div>

    {!! Form::close() !!}

@endsection
