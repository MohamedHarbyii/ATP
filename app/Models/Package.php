<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Package extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = ['game_id','name','price','sessions_count','description','gender'];
    public function game() {
        return $this->belongsTo(Game::class);
    }

}
