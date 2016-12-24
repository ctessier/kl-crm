@extends('layouts.app')

@section('header', 'Mot de passe oublié')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => '/password/email', 'method' => 'post', 'role' => 'form']) !!}

                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::label('email', 'Adresse E-Mail') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>

                    {!! Form::submit('Réinitialiser mon mot de passe', ['class' => 'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
