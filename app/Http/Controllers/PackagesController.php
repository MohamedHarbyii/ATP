<?php

namespace App\Http\Controllers;

use App\PackageDB;
use App\Models\Package;
use App\Http\Resources\PackageResource;
use App\Http\Requests\StorepackageRequest;
use App\Http\Requests\UpdatepackageRequest;
use Illuminate\Routing\Controllers\Middleware;

class PackagesController extends Controller
{
    //     public static function middleware(): array
    // {
    //     return [
    //         new Middleware('auth:sanctum', null, ['index', 'show']),
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepackageRequest $request)
    {
        $package = PackageDB::store($request->validated());

        return $this->sendSuccess(new PackageResource($package), 'package created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {

        return $this->sendSuccess(new PackageResource($package), 'package retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepackageRequest $request, Package $package)
    {
        $updated = PackageDB::update($package, $request->validated());

        return $this->sendSuccess(new PackageResource($updated), 'package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        PackageDB::delete($package);

        return $this->sendSuccess(null, 'package deleted successfully');
    }
}
