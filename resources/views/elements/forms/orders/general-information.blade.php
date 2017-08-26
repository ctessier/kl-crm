<div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
    {{ Form::label('reference', trans('label.reference')) }}
    {{ Form::text('reference', null, ['class' => 'form-control']) }}
    {!! $errors->first('reference', '<span class="help-block">:message</span>') !!}
</div>
