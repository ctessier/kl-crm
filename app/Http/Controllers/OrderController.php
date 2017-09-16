<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('owner:order', [
            'only' => [
                'show',
                'edit',
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
        $orders = $this->user->orders;

        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $order = new Order();
        $order->user_id = $this->user->id;
        $reference = ucfirst(Carbon::now()->formatLocalized('%B %Y')).' #';
        $counter = 1;
        while (Order::where('reference', $reference.$counter)->first()) {
            ++$counter;
        }
        $order->reference = $reference.$counter;
        $order->save();

        $orphan_consumer_orders = ConsumerOrder::whereNull('order_id')->get();
        foreach ($orphan_consumer_orders as $consumer_order) {
            $consumer_order->order()->associate($order)->save();
        }

        \Alert::success('Le nouvelle commande a bien été créée !')->flash();

        return redirect()->route('orders.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
}
