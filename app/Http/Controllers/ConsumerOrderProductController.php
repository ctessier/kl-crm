<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\ConsumerOrdersProduct;
use App\Http\Requests\ConsumerOrderProductStoreRequest;
use App\Http\Requests\ConsumerOrderProductUpdateRequest;
use App\Product;

class ConsumerOrderProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('owner:consumer_order', [
            'only' => [
                'create',
                'store',
                'edit',
                'update',
                'destroy',
            ],
        ]);

        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\ConsumerOrder $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ConsumerOrder $consumer_order)
    {
        // Get list of products
        $products = Product::pluck('name', 'id');

        return view('consumer_orders.products.create')
            ->with('consumer_order', $consumer_order)
            ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ConsumerOrderProductStoreRequest $request
     * @param \App\ConsumerOrder                                  $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerOrderProductStoreRequest $request, ConsumerOrder $consumer_order)
    {
        $product = Product::find($request->get('product_id'));
        $quantity = $request->get('quantity');
        $from_stock = $request->get('from_stock');

        if (!$from_stock || ($from_stock && $this->updateStock($product, $quantity))) {
            $consumer_order->products()->save($product, [
                'quantity'   => $quantity,
                'from_stock' => $from_stock ? $from_stock : false,
            ]);

            $consumer_order->touch();

            \Alert::success('Le produit a été ajouté !')->flash();
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ConsumerOrder $consumer_order
     * @param Product       $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsumerOrder $consumer_order, Product $product)
    {
        $consumer_orders_product = ConsumerOrdersProduct::where('consumer_order_id', $consumer_order->id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        // Get list of products
        $products = Product::pluck('name', 'id');

        return view('consumer_orders.products.edit')
            ->with('consumer_orders_product', $consumer_orders_product)
            ->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ConsumerOrderProductUpdateRequest $request
     * @param \App\ConsumerOrder                                   $consumer_order
     * @param \App\Product                                         $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerOrderProductUpdateRequest $request, ConsumerOrder $consumer_order, Product $product)
    {
        $quantity = $request->get('quantity');
        $from_stock = $request->get('from_stock') ? true : false;

        if ($this->updateStock($product, $quantity, $consumer_order, $from_stock)) {
            $consumer_order->products()->updateExistingPivot($product->id, [
                'quantity'   => $quantity,
                'from_stock' => $from_stock ? $from_stock : false,
            ]);

            $consumer_order->touch();

            \Alert::success('Le produit a été mis à jour !')->flash();
        }

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ConsumerOrder $consumer_order
     * @param \App\Product       $product
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsumerOrder $consumer_order, Product $product)
    {
        try {
            // Update stock if needed
            $consumer_order_product = $consumer_order->products()->find($product->id)->pivot;
            if ($consumer_order_product->from_stock) {
                $stock = $this->user->products()->find($product->id)->pivot;
                $this->user->products()->updateExistingPivot($product->id, [
                    'quantity' => $stock->quantity + $consumer_order_product->quantity,
                ]);

                \Alert::warning('Le produit a été replacé dans le stock.')->flash();
            }
        } catch (\Exception $ex) {
            \Alert::error('Impossible de mettre à jour le stock.')->flash();
        }

        $consumer_order->products()->detach($product->id);

        $consumer_order->touch();

        \Alert::success('Produit supprimé avec succès !')->flash();

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }

    /**
     * Update the user's stock from a given product and quantity to take out.
     *
     * @param \App\Product       $product
     * @param int                $quantity
     * @param \App\ConsumerOrder $consumer_order
     * @param bool|null          $from_stock
     *
     * @return bool
     */
    private function updateStock($product, $quantity, $consumer_order = null, $from_stock = null)
    {
        try {
            $stock = $this->user->products()->find($product->id)->pivot;

            $previous_from_stock = null;
            if ($from_stock !== null) {
                $previous_from_stock = $consumer_order->products()->find($product->id)->pivot->from_stock;
            }

            if ($from_stock === null || (!$previous_from_stock && $from_stock)) {
                // New product or it was not taken from stock but now it is, we decrease the stock by the quantity
                $newStock = $stock->quantity - $quantity;
            } elseif ($previous_from_stock && !$from_stock) {
                // Update of a product and it was taken from stock but it is not anymore, we add the previous quantity
                $newStock = $stock->quantity + $consumer_order->products()->find($product->id)->pivot->quantity;
            } elseif ($previous_from_stock && $from_stock) {
                // Update of a product and it is still taken from stock, we add/sub the difference
                $newStock = $stock->quantity + $consumer_order->products()->find($product->id)->pivot->quantity
                    - $quantity;
            } else {
                // The product was not and is still not from stock
                return true;
            }

            if ($newStock >= 0) {
                // Update stock
                $this->user->products()->updateExistingPivot($product->id, [
                    'quantity' => $newStock,
                ]);

                // Warn is stock is now empty for the product
                if ($newStock === 0) {
                    \Alert::warning('Votre stock est désormais vide pour ce produit.')->flash();
                } else {
                    \Alert::warning('Votre stock est désormais de '.$newStock.' pour ce produit.')->flash();
                }

                return true;
            } else {
                \Alert::error('Vous n\'avez pas le stock disponible.')->flash();

                return false;
            }
        } catch (\Exception $ex) {
            \Alert::error('Impossible de mettre à jour le stock.')->flash();

            return false;
        }
    }
}
