@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers') }}<small>{{ $consumer->full_name }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li><a href="{{ route('consumers.index') }}">{{ trans('general.consumers') }}</a></li>
            <li class="active">{{ $consumer->full_name }}</li>
        </ol>
    </section>
@endsection

@section('content')
    {!! Form::model($consumer, ['route' => ['consumers.update', $consumer], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">@lang('title.personal-information')</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.personal-information')
                </div>
            </div>
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">@lang('label.consumer-status') {{ config('backpack.base.project_name') }}</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.status')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">@lang('title.contact-details')</h3>
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
