<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    {!! Form::label('address', trans('label.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : '' }}">
            {!! Form::label('postal_code', trans('label.postal-code')) !!}
            {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
            {!! $errors->first('postal_code', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
            {!! Form::label('city', trans('label.city')) !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
            {!! $errors->first('city', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    {!! Form::label('email', trans('label.email')) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
    {!! Form::label('phone', trans('label.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
</div>
