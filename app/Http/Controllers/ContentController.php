<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Resources\ContentResource;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\ContentDB; // كلاس اللوجيك اللي عملناه
use Illuminate\Routing\Controllers\Middleware;

class ContentController extends Controller
{
    // public static function middleware(): array
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
        // بنجيب كل المحتوى من الداتا بيز كلاس
        $contents = ContentDB::all();

        return $this->sendSuccess(ContentResource::collection($contents));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContentRequest $request)
    {
        // بنبعت البيانات المتأكد منها (validated) للحفظ
        $content = ContentDB::store($request->validated());

        return $this->sendSuccess(
            new ContentResource($content),
            'Content created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        // عرض عنصر واحد (مش محتاجين load media هنا لأن مفيش صور)
        return $this->sendSuccess(new ContentResource($content));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, Content $content)
    {
        // تحديث العنصر
        $updatedContent = ContentDB::update($content, $request->validated());

        return $this->sendSuccess(
            new ContentResource($updatedContent),
            'Content updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        // حذف العنصر
        ContentDB::delete($content);

        return $this->sendSuccess(null, 'Content deleted successfully');
    }
}
