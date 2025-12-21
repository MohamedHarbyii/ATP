<?php

namespace App;

use App\Models\Content;

class ContentDB
{
    /**
     * Get All Contents
     */
    public static function all()
    {
        return Content::all();
    }

    /**
     * Store New Content
     */
    public static function store($data)
    {
        return Content::create($data);
    }

    /**
     * Update Content
     */
    public static function update(Content $content, $data)
    {
        $content->update($data);
        
        return $content;
    }

    /**
     * Delete Content
     */
    public static function delete($content)
    {
        $content->delete();
        return true;
    }
}