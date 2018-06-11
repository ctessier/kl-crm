<?php

namespace App\Http\Controllers;

use App\ConsumerOrder;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $data = $this->user->consumer_orders()
            ->has('order')
            ->with('order')
            ->get()
            ->groupBy(function($d) {
                return Carbon::parse($d->month)->format('Ym');
            })
            ->map(function ($month) {
                return $month->groupBy('order_id');
            });

        return view('orders.index', compact('data'));
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
            $counter++;
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

    /**
     * Store the fillers given in request in existing filler consumer order or create a new one.
     *
     * @param Request $request
     * @param Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFillers(Request $request, Order $order)
    {
        $this->validate($request, [
            'product.*'  => 'required|unique|exists:products,id',
            'quantity.*' => 'required|min:1',
        ]);

        $consumer_order = $order->consumer_orders()->whereNull('consumer_id')->first();
        if (!$consumer_order) {
            $consumer_order = new ConsumerOrder();
            $consumer_order->reference = '';
            $consumer_order->month = date('m/Y');
            $consumer_order->order_id = $order->id;
            $consumer_order->user_id = $this->user->id;
            $consumer_order->save();
        }

        $quantities = $request->get('quantities');
        foreach ($request->get('products') as $key => $product_id) {
            $product = $consumer_order->products()->where('product_id', $product_id)->first();
            if (!$product) {
                $consumer_order->products()->attach($product_id, [
                    'quantity'   => $quantities[$key],
                    'from_stock' => false,
                ]);
            } else {
                $quantity = $product->pivot->quantity + $quantities[$key];
                $consumer_order->products()->updateExistingPivot($product_id, [
                    'quantity' => $quantity,
                ]);
            }
        }

        \Alert::success(trans('alert.success.store-filler'))->flash();

        return redirect()->route('orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->consumer_orders->map(function ($consumer_order) {
            $consumer_order->order()->dissociate()->save();
        });

        $order->delete();

        return redirect()->route('orders.index');
    }
}
