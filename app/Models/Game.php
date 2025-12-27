<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Game extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $withCount = ['packages'];

    protected $with = ['packages'];

    protected $fillable = ['name', 'description'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'game_coach');
    }
}
