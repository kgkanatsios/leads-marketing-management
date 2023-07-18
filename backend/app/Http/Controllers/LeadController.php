<?php

namespace App\Http\Controllers;

use App\Exceptions\LeadNotFoundException;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\LeadResource;
use App\Interfaces\Repositories\LeadRepositoryInterface;
use App\Jobs\EmailMarketingMemberAddJob;
use App\Jobs\EmailMarketingMemberDeleteJob;
use App\Jobs\EmailMarketingMemberSyncJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LeadController extends Controller
{
    private $repository;

    public function __construct(LeadRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = $this->repository::all();

        return new LeadCollection($leads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeadRequest $request)
    {
        $lead = $this->repository::create($request->input());
        EmailMarketingMemberAddJob::dispatch($lead->id)->onQueue('addMarketingMember');

        return new LeadResource($lead);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        try {
            $lead = $this->repository::findById($id);
        } catch (ModelNotFoundException $e) {
            throw new LeadNotFoundException();
        }

        return new LeadResource($lead);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeadRequest  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeadRequest $request, string $id)
    {
        try {
            $lead = $this->repository::updateById($id, $request->input());
        } catch (ModelNotFoundException $e) {
            throw new LeadNotFoundException();
        }

        EmailMarketingMemberSyncJob::dispatch($lead->id)->onQueue('syncMarketingMember');

        return new LeadResource($lead);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $lead = $this->repository::findById($id);
            $this->repository::destroyById($id);
        } catch (ModelNotFoundException $e) {
            throw new LeadNotFoundException();
        }

        EmailMarketingMemberDeleteJob::dispatch($id, $lead->email)->onQueue('deleteMarketingMember');

        return response()->json([], 204);
    }
}
