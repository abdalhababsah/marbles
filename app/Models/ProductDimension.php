<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDimension extends Model
{

    protected $guarded = [];

    use HasFactory;


    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
