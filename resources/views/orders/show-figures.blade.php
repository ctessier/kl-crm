<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $order->getTotalProductsQuantity() }}</h3>
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
                <h3>{{ $order->getTotalProductsQuantity(true) }}</h3>
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
                <h3>&nbsp;</h3>
                <p>cartons</p>
            </div>
            <div class="icon">
                <i class="fa fa-dropbox"></i>
            </div>
        </div>
    </div>
</div>
