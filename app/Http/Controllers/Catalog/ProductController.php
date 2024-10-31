<?php

namespace App\Http\Controllers\Catalog;

use App\DataTables\Catalog\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductImage;
use App\Models\VariantType;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('pages.catalog.products.list');
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $variants =VariantType::all();
        $categories = category::all();
//        dd($variants);
        return view('pages.catalog.products.create',compact('categories','variants'));
    }

    private function createArabicSlug($text)
    {
        $text = str_replace(' ', '-', $text);
        $text = preg_replace('/[^\p{Arabic}0-9-]/u', '', $text);
        $text = mb_strtolower($text, 'UTF-8');
        return $text;
    }

    public function store(ProductStoreRequest $request): \Illuminate\Http\JsonResponse
    {
//        dd($request);
        $validatedData = $request->validated();
        $validatedData['slug_en'] = Str::slug($validatedData['name_en']);
        $validatedData['slug_ar'] = $this->createArabicSlug($validatedData['name_ar']);
        unset($validatedData['images']);

        $dimensionsData = $validatedData['dimensions'] ?? null;
        $variantsData = $validatedData['variants'] ?? [];
        $inventoryQuantity = $validatedData['quantity_available'] ?? null;
        unset($validatedData['dimensions'], $validatedData['variants'], $validatedData['quantity_available']);

        try {
            DB::beginTransaction();

            $product = Product::create($validatedData);

            if ($dimensionsData) {
                $product->dimension()->create($dimensionsData);
            }

            foreach ($variantsData as $variant) {
                $product->variants()->create($variant);
            }

            if ($inventoryQuantity !== null) {
                $product->inventory()->create(['quantity_available' => $inventoryQuantity]);
            }


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    // Generate a unique filename for each image
                    $filename = Str::slug($validatedData['name_en'], '_') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $filePath = $image->storeAs('public/images', $filename); // Saving the file to the storage
                    $databasePath = 'storage/images/' . $filename; // Preparing the path for database

                    // Save the image path in relation to the product
                    $product->images()->create(['image_path' => $databasePath]);
                }
            }


            DB::commit();
            return response()->json(['message' => 'Product and its inventory added successfully', 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to add Product', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::with(['variants.variantType', 'category', 'images', 'dimension', 'seo', 'variants.inventory'])->findOrFail($id);
        return view('pages.catalog.products.create',compact($product));
    }

    public function edit(string $id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::with(['variants.variantType', 'category', 'images', 'dimension', 'seo', 'variants','inventory'])->findOrFail($id);
        $varientTypes =VariantType::all();
//        dd($product,$varientTypes);

        $categories = Category::get();
        return view('pages.catalog.products.edit', compact('product', 'categories','varientTypes'));
    }


    public function update(ProductUpdateRequest $request, $productId): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($productId);


            $product->update($validatedData);


            if (isset($validatedData['dimensions'])) {
                $product->dimension()->update($validatedData['dimensions']);
            }

            if (isset($validatedData['variants'])) {
                foreach ($validatedData['variants'] as $variantData) {
                    if (isset($variantData['id'])) {

                        $product->variants()->where('id', $variantData['id'])->update($variantData);
                    } else {

                        $product->variants()->create($variantData);
                    }
                }
            }

            if (isset($validatedData['removed_variants'])) {
                $product->variants()->whereIn('id', $validatedData['removed_variants'])->delete();
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = Str::slug($request->input('name_en'), '_') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $filePath = $image->storeAs('public/images', $filename); // Saving the file to the storage
                    $databasePath = 'storage/images/' . $filename; // Preparing the path for database

                    $product->images()->create(['image_path' => $databasePath]);
                }
            }



            if (isset($validatedData['removed_images'])) {
                $imagesToRemove = $product->images()->whereIn('id', $validatedData['removed_images'])->get();
                foreach ($imagesToRemove as $image) {
                    $pathInStorage = str_replace('storage/', '', $image->image_path);
                    Storage::disk('public')->delete($pathInStorage);
                    $image->delete();
                }
            }

            DB::commit();

            return response()->json(['message' => 'Product Updated Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update Product', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy($productId): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($productId);

            $product->dimension()->delete();

            $product->variants()->delete();


            foreach ($product->images as $image) {
                $pathInStorage = str_replace('storage/', '', $image->image_path);
                Storage::disk('public')->delete($pathInStorage);
                $image->delete();
            }

            $product->delete();

            DB::commit();

            return response()->json(['message' => 'Product Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete Product', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function getProductImages($productId): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::findOrFail($productId);
            $images = $product->images()->pluck('image_path')->toArray();
            return response()->json(['images' => $images, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch product images', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function updateImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $productId = $request->input('product_id');
        $action = $request->input('action'); // 'add' or 'delete'
        $imagePath = $request->input('image_path');

        try {
            $product = Product::findOrFail($productId);

            if ($action === 'add') {
                $image = $request->file('image');
                $filename = Str::slug($product->name_en, '_') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $filePath = $image->storeAs('public/images', $filename);
                $databasePath = 'storage/images/' . $filename;
                $product->images()->create(['image_path' => $databasePath]);
                $message = 'Image added successfully';
            } elseif ($action === 'delete') {
                $productImage = ProductImage::where('product_id', $productId)
                    ->where('image_path', $imagePath)
                    ->first();
                if ($productImage) {
//                    dd($productImage);
                    // Delete the image from storage
                    Storage::delete($productImage->image_path);
                    $productImage->delete();
                    $message = 'Image deleted successfully';
                } else {
                    return response()->json(['message' => 'Image not found', 'status' => 404]);
                }

            } else {
                return response()->json(['message' => 'Invalid action', 'status' => 400]);
            }

            return response()->json(['message' => $message, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update image', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function updateStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $status = $request->input('status');

            $product = Product::findOrFail($productId);
            $product->status = $status;
            $product->save();

            return response()->json(['message' => 'Product status updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product status', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
    public function updateCategoryType(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $categoryType = $request->input('category_type');

            $product = Product::findOrFail($productId);
            $product->category_type = $categoryType;
            $product->save();

            return response()->json(['message' => 'Product category type updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product category type', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
    public function updateCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $categoryId = $request->input('category_id');

            $product = Product::findOrFail($productId);
            $product->category_id = $categoryId;
            $product->save();

            return response()->json(['message' => 'Product category updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product category', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function updateDimensions(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $dimensions = $request->input('dimensions');

            $product = Product::findOrFail($productId);
            $product->dimension()->update($dimensions);

            return response()->json(['message' => 'Product dimensions updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product dimensions', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
    public function updateGeneral(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $productNameEn = $request->input('name_en');
            $productNameAr = $request->input('name_ar');
            $descriptionEn = $request->input('description_en');
            $descriptionAr = $request->input('description_ar');

            $product = Product::findOrFail($productId);

            $product->name_en = $productNameEn;
            $product->name_ar = $productNameAr;
            $product->description_en = $descriptionEn;
            $product->description_ar = $descriptionAr;
            $product->save();
            return response()->json(['message' => 'General product information updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update general product information', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
    public function updateProductInventory(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $productId = $request->input('product_id');
            $quantityAvailable = $request->input('quantity_available');

            $product = Product::findOrFail($productId);
            $product->inventory->update(['quantity_available' => $quantityAvailable]);

            return response()->json(['message' => 'Product inventory updated successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product inventory', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function updateVariations(Request $request)
    {
        $productId = $request->input('product_id');
        $variations = $request->input('variations');

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($productId);

            // Get all existing variant IDs for the product
            $existingVariantIds = $product->variants()->pluck('id')->toArray();

            foreach ($variations as $variation) {
                if (isset($variation['id']) && $variation['is_new_variant'] == 'false') { // Existing variant - Update
                    $existingVariant = Variant::findOrFail($variation['id']);
                    $existingVariant->update([
                        'variant_type_id' => $variation['variant_type_id'],
                        'variant_value_en' => $variation['variant_value_en'],
                        'variant_value_ar' => $variation['variant_value_ar'],
                    ]);

                    // Remove the updated variant ID from the existing IDs array
                    $index = array_search($variation['id'], $existingVariantIds);
                    if ($index !== false) {
                        unset($existingVariantIds[$index]);
                    }
                } else {
                    if ($variation['is_new_variant'] == 'true') {
                        $variantData = [
                            'product_id' => $productId,
                            'variant_type_id' => $variation['variant_type_id'],
                            'variant_value_en' => $variation['variant_value_en'],
                            'variant_value_ar' => $variation['variant_value_ar'],
                        ];
                        $product->variants()->create($variantData);
                    }
                }
            }

            // Delete any remaining variants in the database that were not included in the request
            Variant::whereIn('id', $existingVariantIds)->delete();

            DB::commit();
            return response()->json(['message' => 'Product variations updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update product variations', 'error' => $e->getMessage()], 500);
        }
    }
}
