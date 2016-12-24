@extends('layouts.app')

@section('header', 'Créer mon compte')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => '/register', 'method' => 'post', 'role' => 'form']) !!}

                    {{ csrf_field() }}

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

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('password', 'Mot de passe') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        {!! Form::label('password_confirmation', 'Confirmation de mot de passe') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::submit('M\'enregistrer', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
