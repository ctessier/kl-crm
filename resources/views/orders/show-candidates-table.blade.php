@inject('orders_service', 'App\Services\OrdersService')

@if (($candidates = $orders_service->getFillerCandidates($order, $user->products))->isNotEmpty())

    {!! Form::open(['route' => ['orders.fillers.store', $order->id], 'method' => 'post']) !!}

        <h4>Suggestions pour avenant</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ trans('label.product') }}</th>
                    <th>{{ trans('label.quantity') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->product->name }}</td>
                    <td>
                        {!! Form::hidden('products['.$loop->index.']', $candidate->product->id) !!}
                        {!! Form::selectRange('quantities['.$loop->index.']', 1, config('krisslaure.stock-range-max'), $candidate->quantity, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! Form::submit($order->hasFillers() ? trans('actions.update') : trans('actions.add'), ['class' => 'btn btn-default pull-right']) !!}

    {!! Form::close() !!}

@endif
