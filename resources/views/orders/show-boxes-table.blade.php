@inject('orders_service', 'App\Services\OrdersService')

<table class="table table-bordered">
    <thead>
    <tr>
        <th></th>
        <th>Type</th>
        <th>Complet ?</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orders_service->getBoxes($order) as $box)
        <tr>
            <td>
                Carton {{ $loop->index + 1 }}
            </td>
            <td>
                {{ $box->type->name }}
            </td>
            <td>
                {{ trans('general.'.($box->isFull() ? 'yes' : 'no')) }} ({{ $box->getQuantity() }})
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@foreach ($orders_service->getFillerCandidates($order, $user->products) as $candidate)
    {{ $candidate->product->name }} ({{ $candidate->quantity }})<br />
@endforeach
