<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\Http\Requests\ConsumerOrderRequest;
use App\Product;
use App\Repository\ConsumerOrdersRepository;
use App\Repository\ConsumersRepository;

class ConsumerOrderController extends Controller
{
    /**
     * @var ConsumersRepository
     */
    protected $consumers_repository;

    /**
     * @var ConsumerOrdersRepository
     */
    protected $consumer_orders_repository;

    /**
     * ConsumerOrderController constructor.
     *
     * @param ConsumersRepository      $consumer_repository
     * @param ConsumerOrdersRepository $consumer_orders_repository
     */
    public function __construct(
        ConsumersRepository $consumer_repository,
        ConsumerOrdersRepository $consumer_orders_repository
    ) {
        $this->middleware('auth');

        $this->middleware('owner:consumer_order', [
            'only' => [
                'edit',
                'update',
                'destroy',
            ],
        ]);

        $this->consumers_repository = $consumer_repository;
        $this->consumer_orders_repository = $consumer_orders_repository;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumer_orders = $this->consumer_orders_repository->getUsersConsumerOrders($this->user);

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
        $consumers = $this->consumers_repository->getUsersConsumersList($this->user);

        // Get user's orders
        $orders = $this->user->orders()
            ->pluck('reference', 'id')
            ->prepend(trans('placeholder.select-order'), '');

        return view('consumer_orders.create')
            ->with('consumers', $consumers)
            ->with('orders', $orders);
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
        $consumer_order->fill($request->except(['stock']));
        $consumer_order->user_id = $this->user->id;

        $consumer_order->save();

        return redirect()->route('consumer_orders.edit', [
            'consumer_order' => $consumer_order,
        ]);
    }

    /**
     * Display the specified resource for being edited.
     *
     * @param \App\ConsumerOrder $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsumerOrder $consumer_order)
    {
        // Get the list of the user's consumers
        $consumers = $this->consumers_repository->getUsersConsumersList($this->user);

        // Get the list of products
        $products = Product::pluck('name', 'id');

        // Get user's orders
        $orders = $this->user->orders()
            ->pluck('reference', 'id')
            ->prepend(trans('placeholder.select-order'), '');

        return view('consumer_orders.edit')
            ->with('consumer_order', $consumer_order)
            ->with('consumers', $consumers)
            ->with('products', $products)
            ->with('orders', $orders);
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
        $consumer_order->fill($request->except(['stock']));

        $consumer_order->save();

        \Alert::success('Le commande a bien été modifiée !')->flash();

        return redirect()->back();
    }

    /**
     * Detach the specified resource from its order.
     *
     * @param ConsumerOrder $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function detach(ConsumerOrder $consumer_order)
    {
        $order = $consumer_order->order;
        $consumer_order->order()->dissociate();
        $consumer_order->save();

        \Alert::success(trans('alert.success.consumer-order-detached'))->flash();

        return redirect()->route('orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ConsumerOrder $consumer_order
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsumerOrder $consumer_order)
    {
        $consumer_order->delete();

        if ($consumer_order->consumer_id) {
            \Alert::success(trans('alert.success.consumer-order-deleted'))->flash();
        } else {
            \Alert::success(trans('alert.success.filler-deleted'))->flash();
        }

        return redirect()->back();
    }
}
