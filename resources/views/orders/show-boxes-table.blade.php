@inject('orders_service', 'App\Services\OrdersService')

@if (($boxes = $orders_service->getBoxes($order))->isNotEmpty())
<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Type</th>
            <th>Complet ?</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($boxes as $box)
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
@endif
