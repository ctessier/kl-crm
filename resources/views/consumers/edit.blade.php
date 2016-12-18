@extends('layouts.app')

@section('header', 'Modifier le consommateur')

@section('content')
    {!! Form::model($consumer, ['route' => ['consumers.update', $consumer], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Informations personnelles</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.personnal-information')
                </div>
            </div>
            <div class="box">
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
                                    {!! Form::text('date', $consumer->current_status->date, ['class' => 'form-control pull-right', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd', 'data-date-language' => 'fr', 'data-date-autoclose' => 'true']) !!}
                                </div>
                                {!! $errors->first('date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Coordonnées</h3>
                </div>
                <div class="box-body">
                    @include('elements.forms.consumers.coordinates')
                </div>
            </div>
            {!! Form::submit('Enregistrer', ['class' => 'btn btn-default']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
