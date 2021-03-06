<div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }}">
    {{ Form::label('reference', trans('label.reference')) }}
    {{ Form::text('reference', null, ['class' => 'form-control']) }}
    {!! $errors->first('reference', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has('consumer_id') ? ' has-error' : '' }}">
    {{ Form::label('consumer_id', trans('label.consumer')) }}
    {{ Form::select('consumer_id', $consumers, null, ['class' => 'form-control']) }}
    {!! $errors->first('consumer_id', '<span class="help-block">:message</span>') !!}
    @if (isset($consumer_order) && $consumer_order->consumer)
        <a href="{{ route('consumers.edit', $consumer_order->consumer) }}" class="btn btn-xs btn-default">
            <i class="fa fa-arrow-right"></i>
            {{ trans('actions.go-to-consumer') }}
        </a>
    @endif
</div>
<div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
    <div class="checkbox">
        <label for="stock">
            {{ Form::checkbox('stock', true, (isset($consumer_order) && !$consumer_order->consumer), ['id' => 'stock']) }}
            {{ trans('label.stock') }}
        </label>
        {!! $errors->first('stock', '<span class="help-block">:message</span>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('order_id') ? ' has-error' : '' }}">
    {{ Form::label('order_id', trans('label.order')) }}
    {{ Form::select('order_id', $orders, null, ['class' => 'form-control']) }}
    {!! $errors->first('order_id', '<span class="help-block">:message</span>') !!}
    @if (isset($consumer_order) && $consumer_order->order)
        <a href="{{ route('orders.show', $consumer_order->order) }}" class="btn btn-xs btn-default">
            <i class="fa fa-arrow-right"></i>
            {{ trans('actions.go-to-order') }}
        </a>
    @endif
</div>
<div class="form-group {{ $errors->has('month') ? 'has-error' : '' }}">
    {!! Form::label('month', trans('label.month')) !!}
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('month', isset($consumer_order) ? $consumer_order->month->format('m/Y') : date('m/Y'), ['class' => 'form-control pull-right', 'data-provide' => 'datepicker', 'data-date-format' => 'mm/yyyy', 'data-date-language' => 'fr', 'data-date-autoclose' => 'true', 'data-date-min-view-mode' => 'months']) !!}
    </div>
    {!! $errors->first('month', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group{{ $errors->has('is_test_program') ? ' has-error' : '' }}">
    <div class="checkbox">
        <label for="is_test_program">
            {{ Form::checkbox('is_test_program', true, null, ['id' => 'is_test_program']) }}
            {{ trans('label.is-test-program') }}
        </label>
        {!! $errors->first('is_test_program', '<span class="help-block">:message</span>') !!}
    </div>
</div>
