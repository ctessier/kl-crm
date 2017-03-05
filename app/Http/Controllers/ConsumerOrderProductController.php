<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\ConsumerOrdersProduct;
use App\Http\Requests\ConsumerOrderProductRequest;
use App\Product;

class ConsumerOrderProductController extends Controller
{
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
     * @param \App\Http\Requests\ConsumerOrderProductRequest $request
     * @param \App\ConsumerOrder                             $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerOrderProductRequest $request, ConsumerOrder $consumer_order)
    {
        $product = Product::find($request->get('product_id'));
        $consumer_order->products()->save($product, [
            'quantity' => $request->get('quantity'),
        ]);

        \Alert::success('Le produit a été ajouté !')->flash();

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
     * @param \App\Http\Requests\ConsumerOrderProductRequest $request
     * @param \App\ConsumerOrder                             $consumer_order
     * @param \App\Product                                   $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerOrderProductRequest $request, ConsumerOrder $consumer_order, Product $product)
    {
        $consumer_order->products()->updateExistingPivot($product->id, [
            'product_id' => $request->get('product_id'),
            'quantity'   => $request->get('quantity'),
        ]);

        \Alert::success('Produit mis à jour !')->flash();

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
        $consumer_order->products()->detach($product->id);

        \Alert::success('Produit supprimé avec succès !')->flash();

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }
}
