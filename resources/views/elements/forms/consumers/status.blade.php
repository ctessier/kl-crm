<div id="consumer-status">
    <div class="row">
        <div class="col-md-7">
            <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                {!! Form::label('status_id', trans('label.consumer-status')) !!}
                {!! Form::select('status_id', \App\ConsumerStatus::pluck('label', 'id'), isset($consumer) ? $consumer->current_status->status_id : null, ['class' => 'form-control']) !!}
                {!! $errors->first('status_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                {!! Form::label('date', trans('label.status-date')) !!}
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    {!! Form::text('date', isset($consumer) ? $consumer->current_status->date->format('d/m/Y') : date('d/m/Y'), ['class' => 'form-control pull-right', 'data-provide' => 'datepicker', 'data-date-format' => 'dd/mm/yyyy', 'data-date-language' => 'fr', 'data-date-autoclose' => 'true']) !!}
                </div>
                {!! $errors->first('date', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>
    <div class="row" id="status-member">
        <div class="col-md-7">
            <div class="form-group {{ $errors->has('membership_number') ? 'has-error' : '' }}">
                {!! Form::label('membership_number', trans('label.membership-number')) !!}
                {!! Form::text('membership_number', isset($consumer) ? $consumer->current_status->membership_number : null, ['class' => 'form-control']) !!}
                {!! $errors->first('membership_number', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group {{ $errors->has('break') ? 'has-error' : '' }}">
                <div class="checkbox">
                    <label for="break">
                        {{ Form::checkbox('break', true, isset($consumer) && $consumer->current_status->break, ['id' => 'break']) }}
                        @lang('label.status-break')
                    </label>
                    {!! $errors->first('break', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="status-dependant">
        <div class="col-md-7">
            <div class="form-group {{ $errors->has('main_consumer_id') ? 'has-error' : '' }}">
                {{ Form::label('main_consumer_id', trans('label.main-consumer')) }}
                {{ Form::select('main_consumer_id', $consumers, isset($consumer) ? $consumer->current_status->main_consumer_id : null, ['class' => 'form-control']) }}
                {!! $errors->first('main_consumer_id', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>
</div>
