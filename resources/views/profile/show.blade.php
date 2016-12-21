@extends('layouts.app')

@section('header', 'Mon compte')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Mes informations personnelles</h3>
            </div>
            <div class="box-body">
                {!! Form::model($user, ['route' => 'profile.update', 'method' => 'PUT', 'role' => 'form']) !!}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('name', 'Nom') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::label('email', 'Adresse E-Mail') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sécurité</h3>
            </div>
            <div class="box-body">
                {!! Form::open(['route' => 'profile.password.update', 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    {!! Form::label('password', 'Nouveau mot de passe') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    {!! Form::label('password_confirmation', 'Confirmation du mot de passe') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                </div>
                {!! Form::submit('Changer mon mot de passe', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Mes distributeurs</h3>
            </div>
            <div class="box-body">
                Vous n'avez actuellement aucun distributeur.
            </div>
            <div class="box-footer">
                {!! Form::open(['url' => '', 'role' => 'form']) !!}
                <div class="input-group">
                    {!! Form::text('email', null, ['placeholder' => 'Nom', 'class' => 'form-control']) !!}
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default">Ajouter</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>-->
@endsection
