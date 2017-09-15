@inject('orders_service', 'App\Services\OrdersService')

<table id="recap" class="table table-hover">
    <thead>
        <tr>
            <th>{{ trans('label.consumer') }}</th>
            @foreach ($order->products as $product)
            <th class="product-column">
                {{ $product->product->name }}
            </th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->consumer_orders as $consumer_order)
        <tr class="{{ !$consumer_order->consumer ? 'filler' : '' }}">
            <td>
                {{ $consumer_order->consumer ? $consumer_order->consumer->full_name : trans('general.fillers') }}
            </td>
            @foreach ($order->products as $order_consumer_order)
            <td class="product-column">{{ $consumer_order->getProductQuantity($order_consumer_order->product) }}</td>
            @endforeach
            <td>
                {{ link_to_route('consumer_orders.show', trans('actions.edit'), $consumer_order->id, ['class' => 'btn btn-xs btn-default']) }}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <th>Total</th>
        @foreach ($order->products as $consumer_order)
        <th class="text-center">{{ $orders_service->getQuantityByProduct($order, $consumer_order->product) }}</th>
        @endforeach
    </tfoot>
</table>
