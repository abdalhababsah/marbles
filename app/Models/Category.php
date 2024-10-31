<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getIconPathAttribute()
    {
        $icon_path = Arr::get($this->attributes, 'icon_path');
        if ($icon_path)
            return config('app.url') . $icon_path;
        return $icon_path;
    }

}
