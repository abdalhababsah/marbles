<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
class AboutUsApiController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        $aboutUs = AboutUs::select( "content_$lang as content", 'image_path')
            ->first();
        return response()->json($aboutUs);
    }
}
