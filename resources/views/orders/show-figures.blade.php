@inject('orders_service', 'App\Services\OrdersService')

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $orders_service->getTotalProductsQuantity($order) }}</h3>
                <p>boîtes au total</p>
            </div>
            <div class="icon">
                <i class="fa fa-plus"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $orders_service->getTotalProductsQuantity($order, true) }}</h3>
                <p>boîtes prises du stock</p>
            </div>
            <div class="icon">
                <i class="fa fa-minus"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $orders_service->getBoxes($order)->count() }}</h3>
                <p>cartons</p>
            </div>
            <div class="icon">
                <i class="fa fa-dropbox"></i>
            </div>
        </div>
    </div>
</div>
