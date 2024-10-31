<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\DataTables\Catalog\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('pages.catalog.categories.list');
    }

    public function create()
    {
        // Return a view for creating a new Category
        return view('pages.catalog.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'icon_path' => 'image|nullable',
            'description_en' => 'string|nullable',
            'description_ar' => 'string|nullable',
        ]);

        try {
            if ($request->hasFile('icon_path')) {
                $filename = Str::slug($request->input('name_en'), '_');
                $extension = $request->file('icon_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                // Save the file to the storage
                $path = $request->file('icon_path')->storeAs('public/' . $fileNameToStore);
                // Adjust the path for the database
                $validatedData['icon_path'] = 'storage/' . $fileNameToStore;
            }

            $validatedData['slug'] = Str::slug($request->input('name_en'), '-');

            Category::create($validatedData);

            return response()->json(['message' => 'Category Added Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add Category', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }



    public function edit(Category $category)
    {
        // Return a view for editing an existing Category
        return view('pages.catalog.categories.create', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'icon_path' => 'image|nullable',
            'description_en' => 'string|nullable',
            'description_ar' => 'string|nullable',
        ]);

        try {
            if ($request->hasFile('icon_path')) {
                if ($category->icon_path && Storage::exists($category->icon_path)) {
                    Storage::delete($category->icon_path);
                }

                $filename = Str::slug($request->input('name_en'), '_');
                $extension = $request->file('icon_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                // Save the file to the storage
                $path = $request->file('icon_path')->storeAs('public/' . $fileNameToStore);
                // Adjust the path for the database
                $validatedData['icon_path'] = 'storage/' . $fileNameToStore;
            }

            $validatedData['slug'] = Str::slug($request->input('name_en'), '-');

            $category->update($validatedData);

            return response()->json(['message' => 'Category Updated Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update Category', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            // Check if the category has an associated icon and delete it from storage
            if ($category->icon_path) {
                // Remove the 'storage/' part from the path to get the correct path in the 'public' disk
                $imagePath = str_replace('storage/', '', $category->icon_path);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Delete the category from the database
            $category->delete();

            return response()->json(['message' => 'Category Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Category', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

}
