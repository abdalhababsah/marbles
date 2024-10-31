<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeImagesApiController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');

        $images = Home::all()->map(function ($image) use ($lang) {
            return [
                'id' => $image->id,
                'title' => $lang === 'ar' ? $image->image_title_ar : $image->image_title_en,
                'image_path' => $image->image_path,
                'sort_order' => $image->sort_order,
            ];
        });

        return response()->json($images);
    }
}
