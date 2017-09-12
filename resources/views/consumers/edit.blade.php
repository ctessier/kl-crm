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
                    <h3 class="box-title">Informations personnelles</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.personal-information')
                </div>
            </div>
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Statut Kriss-Laure</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                                {!! Form::label('status_id', 'Statut') !!}
                                {!! Form::select('status_id', \App\ConsumerStatus::pluck('label', 'id'), $consumer->current_status->status_id, ['class' => 'form-control']) !!}
                                {!! $errors->first('status_id', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                {!! Form::label('date', 'Date') !!}
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('date', $consumer->current_status->date->format('d/m/Y'), ['class' => 'form-control pull-right', 'data-provide' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'data-date-language' => 'fr', 'data-date-autoclose' => 'true']) !!}
                                </div>
                                {!! $errors->first('date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">Coordonnées</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.contact-details')
                </div>
            </div>
            {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
