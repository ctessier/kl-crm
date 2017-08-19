<?php

namespace App\Http\Controllers;

use App\Consumer;
use App\ConsumerOrder;
use App\Http\Requests\ConsumerOrderRequest;
use App\Product;
use Illuminate\Support\Facades\DB;

class ConsumerOrderController extends Controller
{
    /**
     * ConsumerOrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('owner:consumer_order', [
            'only' => [
                'show',
                'update',
                'destroy',
            ],
        ]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumer_orders = $this->user->consumer_orders;

        return view('consumer_orders.index', compact('consumer_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get user's consumers with their full name
        $consumers = Consumer::select(
            DB::raw("CONCAT(first_name,' ',last_name) AS name"),
            'id')
            ->where('user_id', $this->user->id)
            ->pluck('name', 'id');

        return view('consumer_orders.create')
            ->with('consumers', $consumers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ConsumerOrderRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerOrderRequest $request)
    {
        $consumer_order = new ConsumerOrder();
        $consumer_order->fill($request->all());
        $consumer_order->user_id = $this->user->id;

        $consumer_order->save();

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ConsumerOrder $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ConsumerOrder $consumer_order)
    {
        // Get user's consumers with their full name
        $consumers = Consumer::select(
            DB::raw("CONCAT(first_name,' ',last_name) AS name"),
            'id')
            ->where('user_id', $this->user->id)
            ->pluck('name', 'id');

        // Get list of products
        $products = Product::pluck('name', 'id');

        return view('consumer_orders.show')
            ->with('consumer_order', $consumer_order)
            ->with('consumers', $consumers)
            ->with('products', $products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ConsumerOrderRequest $request
     * @param ConsumerOrder                           $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerOrderRequest $request, ConsumerOrder $consumer_order)
    {
        $consumer_order->fill($request->all());

        $consumer_order->save();

        \Alert::success('Le commande a bien été modifiée !')->flash();

        return redirect()->route('consumer_orders.show', [
            'consumer_order' => $consumer_order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
