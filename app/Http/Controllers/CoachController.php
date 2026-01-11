<?php

namespace App\Http\Controllers;

use App\CoachDB;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Routing\Controllers\Middleware;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() {}

    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('auth:sanctum', null, ['index', 'show']),
    //     ];
    // }

    public function index()
    {
        $coaches = Coach::with(['games'])->get();

        return $this->sendSuccess(CoachResource::collection($coaches));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoachRequest $request)
    {
        $coach = CoachDB::store($request->validated());

        return $this->sendSuccess(new CoachResource($coach), 'coach add successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coach $coach)
    {
        $coach->load('games');

        return $this->sendSuccess(new CoachResource($coach));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoachRequest $request, Coach $coach)
    {

        $coach = CoachDB::update($coach, $request->validated());

        return $this->sendSuccess(new CoachResource($coach), 'coach updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coach $coach)
    {
        CoachDB::delete($coach);

        return $this->sendSuccess(null, 'coach deleted successfully');
    }
}
