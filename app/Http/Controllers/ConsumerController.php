<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumerRequest;
use App\Consumer;
use App\ConsumersConsumerStatus;

class ConsumerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consumers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consumers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ConsumerRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerRequest $request)
    {
        $consumer = new Consumer();
        $consumer->fill($request->except(['status_id', 'date']));
        $consumer->user_id = $this->user->id;

        if ($consumer->save()) {
            $consumer_status = new ConsumersConsumerStatus();
            $consumer_status->fill($request->only('status_id', 'date'));
            $consumer_status->consumer_id = $consumer->id;
            if (!$consumer_status->save()) {
                $consumer->forceDelete();
            }
        }

        \Alert::success($consumer->first_name
            .' fait désormais partie de vos consommateurs !')->flash();

        return redirect()->route('consumers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Consumer $consumer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumer $consumer)
    {
        return view('consumers.edit')
            ->with('consumer', $consumer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ConsumerRequest $request
     * @param \App\Consumer                      $consumer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerRequest $request, Consumer $consumer)
    {
        $consumer->fill($request->except(['status_id', 'date']));

        if ($consumer->save()) {
            $consumer->setStatus($request->get('status_id'), $request->get('date'));
        }

        \Alert::success('Les nouvelles informations de '.$consumer->first_name
            .' ont bien été prises en compte !')->flash();

        return redirect()->route('consumers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Consumer $consumer
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumer $consumer)
    {
        $consumer->statuses()->delete();
        $consumer->delete();

        \Alert::success('Consommateur supprimé avec succès !')->flash();

        return redirect()->route('consumers.index');
    }
}
