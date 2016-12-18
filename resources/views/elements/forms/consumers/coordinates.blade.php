<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    {!! Form::label('address', 'Adresse') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
            {!! Form::label('postal_code', 'Code Postal') !!}
            {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
            {!! $errors->first('postal_code', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
            {!! Form::label('city', 'Ville') !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
            {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::label('email', 'Adresse E-Mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
    {!! Form::label('phone', 'Téléphone') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
</div>
