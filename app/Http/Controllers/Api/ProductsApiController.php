<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GetSlugRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{


    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');

        $product = Product::select('id', "name_$lang as name", "description_$lang as description",
            'products.slug_' . $lang . ' as slug', 'qrcode', 'category_type', 'category_id')
            ->with(["category:id,name_$lang as name,icon_path",
                'inventory:product_id,quantity_available',
                "variants:variant_type_id,product_id,variant_value_$lang as value",
                "variants.variantType:id,name_$lang as name",
                'images:product_id,image_path', 'seo', 'dimension:product_id,length,width,height,dimension_unit'])
            ->when(request('category_slug'), function ($q) {
                $id = Category::where('slug', request('category_slug'))->value('id');
                return $q->where('category_id', $id);
            })->where('products.status', 'active')->get();

        return response()->json($product);
    }

    public function categories(Request $request)
    {
        $lang = $request->get('lang', 'en');

        $categories = Category::select("name_$lang as name", 'slug', 'icon_path')->get();

        return response()->json($categories);
    }

    public function show(Request $request, $id)
    {
        $lang = $request->get('lang', 'en');

        $product = Product::where('id', $id)
            ->select('id', "name_$lang as name", "description_$lang as description",
                'products.slug_' . $lang . ' as slug', 'category_type', 'qrcode', 'category_id')
            ->with(["category:id,name_$lang as name,icon_path",
                'inventory:product_id,quantity_available',
                "variants:variant_type_id,product_id,variant_value_$lang as value",
                "variants.variantType:id,name_$lang as name",
                'images:product_id,image_path',
                'seo',
                'dimension:product_id,length,width,height,dimension_unit'])
            ->first();

        return response()->json($product);
    }

    public function getSlug($slug, GetSlugRequest $request)
    {
        $lang = $request->get('lang', 'en');

        $product = Product::select('id', "name_$lang as name", "slug_$lang as slug", "description_$lang as description", "category_id")
            ->with(["category:id,name_$lang as name,icon_path",
                'inventory:product_id,quantity_available',
                "variants:variant_type_id,product_id,variant_value_$lang as value",
                "variants.variantType:id,name_$lang as name",
                'images:product_id,image_path',
                'seo',
                'dimension:product_id,length,width,height,dimension_unit'])
            ->where(function ($query) use ($slug) {
                return $query->where('slug_en', $slug)
                    ->orWhere('slug_ar', $slug);
            })
            ->first();

        return response()->json($product);
    }

}
