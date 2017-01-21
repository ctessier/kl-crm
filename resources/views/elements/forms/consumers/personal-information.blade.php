<div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
    {!! Form::label('first_name', trans('label.firstname')) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
    {!! Form::label('last_name', trans('label.lastname')) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
    {!! Form::label('sex',  trans('label.sex')) !!}
    {!! Form::select('sex', ['' => '', 'm' => trans('general.male'), 'f' => trans('general.female')], null, ['class' => 'form-control']) !!}
    {!! $errors->first('sex', '<span class="help-block">:message</span>') !!}
</div>
