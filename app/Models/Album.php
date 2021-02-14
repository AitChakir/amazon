<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photo;
class Album extends Model
{
    use HasFactory;


    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    public function getPathAttribute()
    {
    	$url = $this->album_thumb;
    	if (strstr($this->album_thumb, 'http') === false) {
    		$url = 'storage/'.$this->album_thumb;
    	}
    	return $url;
    }

    protected $fillable = ['album_name', 'album_thumb', 'description', 'user_id'];
}
