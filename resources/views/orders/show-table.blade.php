@inject('orders_service', 'App\Services\OrdersService')

<table class="table table-hover">
    <thead>
        <tr>
            <th>{{ trans('label.consumer') }}</th>
            @foreach ($order->products as $product)
            <th class="text-center">
                {{ $product->product->name }}
                ({{ $product->product->category->name }})
            </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($order->consumer_orders as $consumer_order)
        <tr>
            <td>
                {{ $consumer_order->consumer->full_name }}
                {{ link_to_route('consumer_orders.show', trans('actions.view'), $consumer_order->id, ['class' => 'btn btn-xs btn-default']) }}
            </td>
            @foreach ($order->products as $order_consumer_order)
            <td class="text-center">{{ $consumer_order->getProductQuantity($order_consumer_order->product) }}</td>
            @endforeach
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
