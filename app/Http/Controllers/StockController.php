<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Show the stock of the user for editing purpose.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('stock.edit')
            ->with('categories', Category::all());
    }

    /**
     * Update the stock of the authenticated user.
     *
     * @param StockRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StockRequest $request)
    {
        $this->user->products()->sync($request->get('products'));

        \Alert::success('Votre stock a bien été mis à jour !')->flash();

        return redirect()->route('stock.edit');
    }
}
