<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\PartnerDB; // كلاس اللوجيك
use App\Http\Resources\PartnerResource;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use Illuminate\Routing\Controllers\Middleware;

class PartnerController extends Controller
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
        // PartnerDB::all() بترجع الشركاء مع الميديا جاهزة
        $partners = PartnerDB::all();
        
        return $this->sendSuccess(PartnerResource::collection($partners));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        // بنبعت الداتا الموثقة (validated) لـ PartnerDB وهو بيحفظ ويرفع الصورة
        $partner = PartnerDB::store($request->validated());

        return $this->sendSuccess(
            new PartnerResource($partner), 
            'Partner created successfully', 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        // بنعمل load للميديا عشان الريسورس يعرف يعرض الصورة
        $partner->load('media');
        
        return $this->sendSuccess(new PartnerResource($partner));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        // بنبعت الكوتش والداتا الجديدة لـ PartnerDB
        $updatedPartner = PartnerDB::update($partner, $request->validated());

        return $this->sendSuccess(
            new PartnerResource($updatedPartner), 
            'Partner updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        PartnerDB::delete($partner);
        
        return $this->sendSuccess(null, 'Partner deleted successfully');
    }
}