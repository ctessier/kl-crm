<?php

namespace App\Http\Controllers;

use App\Consumer;
use App\ConsumersConsumerStatus;
use App\Http\Requests\ConsumerRequest;
use App\Repository\ConsumersRepository;
use App\Services\ConsumerStatusesService;

class ConsumerController extends Controller
{
    /**
     * @var ConsumersRepository
     */
    protected $consumers_repository;

    /**
     * @var ConsumerStatusesService
     */
    protected $status_service;

    /**
     * Create a new controller instance.
     *
     * @param ConsumersRepository     $consumers_repository
     * @param ConsumerStatusesService $status_service
     */
    public function __construct(ConsumersRepository $consumers_repository, ConsumerStatusesService $status_service)
    {
        $this->middleware('auth');
        $this->middleware('owner:consumer', [
            'only' => [
                'edit',
                'update',
            ],
        ]);

        $this->consumers_repository = $consumers_repository;
        $this->status_service = $status_service;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consumers.index')
            ->with('consumers', $this->user->consumers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consumers = $this->consumers_repository->getUsersConsumersList($this->user);

        return view('consumers.create', compact('consumers'));
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
        $consumer->fill($request->except($this->status_service->getStatusFields()));
        $consumer->user_id = $this->user->id;

        if ($consumer->save()) {
            $consumer_status = new ConsumersConsumerStatus();
            $consumer_status->consumer_id = $consumer->id;
            $consumer_status = $this->status_service->populate($consumer_status, $request);
            if (!$consumer_status->save()) {
                $consumer->forceDelete();
                \Alert::error(trans('alert.error.consumer-store'))->flash();
            } else {
                \Alert::success(trans('alert.success.consumer-store', ['name' => $consumer->first_name]))->flash();
            }
        }

        return redirect()->route('consumers.index');
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
        $consumers = $this->consumers_repository->getUsersConsumersList($this->user);
        unset($consumers[$consumer->id]); // remove custom consumer from list of main consumers

        return view('consumers.edit', compact('consumers', 'consumer'));
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
        $consumer->fill($request->except($this->status_service->getStatusFields()));

        try {
            $consumer->save();
            $this->status_service->setConsumerStatus($consumer, $request)->save();
            \Alert::success(trans('alert.success.consumer-update', ['name' => $consumer->first_name]))->flash();
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            \Alert::error(trans('alert.error.consumer-update'))->flash();
        }

        return redirect()->route('consumers.index');
    }
}
