@extends('layouts.app')

@section('header', 'Connexion')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => '/login', 'method' => 'post', 'role' => 'form']) !!}

                    {{ csrf_field() }}

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

                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                    </div>

                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-default']) !!}
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        Mot de passe oublié ?
                    </a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
