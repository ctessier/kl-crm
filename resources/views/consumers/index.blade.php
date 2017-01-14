@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('krisslaure.consumers') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('krisslaure.consumers') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    @include('consumers.statistics')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                @if ($consumers->count() > 0)
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Adresse e-mail</th>
                                <th>Numéro de téléphone</th>
                                <th>Statut</th>
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
                                    <td>
                                        <!--{!! link_to_route('consumers.show', 'Voir', ['consumers' => $consumer], ['class' => 'btn btn-xs btn-default']) !!}-->
                                        {!! link_to_route('consumers.edit', 'Modifier', ['consumers' => $consumer], ['class' => 'btn btn-xs btn-default']) !!}
                                        {!! Form::open(['route' => ['consumers.destroy', $consumer], 'method' => 'delete', 'class' => 'inline']) !!}
                                            {!! Form::submit('Supprimer', ['class' => 'btn btn-xs btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="box-body">
                    Vous n'avez encore aucun consommateur.
                </div>
                @endif
                <div class="box-footer">
                    {!! link_to_route('consumers.create', 'Nouveau', [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
