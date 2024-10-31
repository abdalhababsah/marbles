<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Home extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_title_en',
        'image_title_ar',
        'image_path',
        'sort_order',
    ];

    public function getImagePathAttribute()
    {
        $image_path = Arr::get($this->attributes, 'image_path');
        if ($image_path)
            return config('app.url') . $image_path;
        return $image_path;
    }
}
