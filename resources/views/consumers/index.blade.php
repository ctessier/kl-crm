@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('general.consumers') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('general.consumers') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    @include('consumers.statistics')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                @if ($consumers->count() > 0)
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('label.firstname') }}</th>
                                <th>{{ trans('label.lastname') }}</th>
                                <th>{{ trans('label.email') }}</th>
                                <th>{{ trans('label.phone') }}</th>
                                <th>{{ trans('label.consumer-status') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consumers as $consumer)
                                <tr>
                                    <td>{{ $consumer->first_name }}</td>
                                    <td>{{ $consumer->last_name }}</td>
                                    <td>{{ $consumer->email }}</td>
                                    <td>{{ $consumer->phone }}</td>
                                    <td>{{ $consumer->current_status ? $consumer->current_status->status->label : '' }}</td>
                                    <td class="text-right">
                                        {!! link_to_route('consumers.edit', trans('actions.edit'), ['consumers' => $consumer], ['class' => 'btn btn-xs btn-default']) !!}
                                        {!! link_to_route('consumer_orders.create', trans('actions.add-consumer-order'), ['consumer_id' => $consumer->id], ['class' => 'btn btn-xs btn-info']) !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="box-body">
                    {{ trans('messages.no-consumers') }}
                </div>
                @endif
                <div class="box-footer">
                    {!! link_to_route('consumers.create', trans('actions.new'), [], ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
