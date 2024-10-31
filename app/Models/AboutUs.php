<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class AboutUs extends Model
{
    use HasFactory;
protected $table = 'about_us';
    protected $guarded = [];

    public function getImagePathAttribute()
    {
        $image_path = Arr::get($this->attributes, 'image_path');
        if ($image_path)
            return config('app.url') . $image_path;
        return $image_path;
    }
}
