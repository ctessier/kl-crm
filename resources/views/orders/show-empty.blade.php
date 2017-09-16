<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">{{ $order->reference }}</h3>
            </div>
            <div class="box-body">
                <p>{{ trans('messages.empty-order') }}</p>
                <p>
                    <a href="{{ route('consumer_orders.create', ['order_id' => $order->id]) }}" class="btn btn-primary text-center">{{ trans('actions.add-consumer-order') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>