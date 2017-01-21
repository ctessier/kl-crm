<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\ConsumerOrdersProduct;
use App\Http\Requests\ConsumerOrderProductRequest;
use App\Product;
use Illuminate\Http\Request;

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
     * @param \App\Http\Requests\ConsumerOrderProductRequest  $request
     * @param \App\ConsumerOrder                              $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerOrderProductRequest $request, ConsumerOrder $consumer_order)
    {
        $consumer_order_product = new ConsumerOrdersProduct();
        $consumer_order_product->fill($request->except('saveAndNew'));
        $consumer_order_product->consumer_order_id = $consumer_order->id;

        $consumer_order_product->save();

        $params = [
            'consumer_order' => $consumer_order,
        ];

        if ($request->get('saveAndNew')) {
            $target = 'consumer_orders.products.create';
        } else {
            $target = 'consumer_orders.show';
        }

        \Alert::success('Le produit a été ajouté !')->flash();

        return redirect()->route($target, $params);
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
     * @param \App\ConsumerOrder $consumer_order
     * @param \App\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerOrderProductRequest $request, ConsumerOrder $consumer_order, Product $product)
    {
        $consumer_orders_product = ConsumerOrdersProduct::where('consumer_order_id', $consumer_order->id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        $consumer_orders_product->fill($request->all());

        $consumer_orders_product->save();

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
        $consumer_order_product = ConsumerOrdersProduct::where('consumer_order_id', $consumer_order->id)
            ->where('product_id', $product->id)
            ->firstOrFail();

        $consumer_order_product->delete();

        \Alert::success('Produit supprimé avec succès !')->flash();

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }
}
