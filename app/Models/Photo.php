<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function getPathAttribute()
    {
    	$url = $this->img_path;
    	if (strstr($this->img_path, 'http') === false) {
    		$url = 'storage/'.$this->img_path;
    	}
    	return $url;
    }
}
