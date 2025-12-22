<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['name','links','description'];
    protected $casts = ['links'=>'array'];
}
