<?php

namespace App\Http\Controllers\Home;

use App\DataTables\Home\AboutUsDataTable;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{
    public function index(AboutUsDataTable $dataTable)
    {
        // Render a DataTable view, assuming you have a blade file at the specified path
        return $dataTable->render('pages.home.about_us.list');
    }

    public function create()
    {
        // Return a view for creating a new About Us entry
        return view('pages.home.about_us.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image_path' => 'required|image',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
        ]);

        try {
            if ($request->hasFile('image_path')) {
                $filename = Str::slug(now()->toDateTimeString(), '_'); // Use current timestamp if name is not available
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                // Save the file to the storage
                $path = $request->file('image_path')->storeAs('public/' . $fileNameToStore);
                // Adjust the path for the database
                $validatedData['image_path'] = 'storage/' . $fileNameToStore;
            }

            AboutUs::create($validatedData);

            return response()->json(['message' => 'About Us Added Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add About Us', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function edit(AboutUs $aboutUs)
    {
        return view('pages.home.about_us.create', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs)
    {
        $validatedData = $request->validate([
            'image_path' => 'image|nullable',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
        ]);

        try {
            if ($request->hasFile('image_path')) {
                // Optionally delete the old image from storage
                if ($aboutUs->image_path) {
                    $oldImagePath = str_replace('storage/', '', $aboutUs->image_path);
                    Storage::disk('public')->delete($oldImagePath);
                }

                $filename = Str::slug(now()->toDateTimeString(), '_'); // Use current timestamp if name is not available
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                // Save the new file to the storage
                $path = $request->file('image_path')->storeAs('public/' . $fileNameToStore);
                // Adjust the path for the database
                $validatedData['image_path'] = 'storage/' . $fileNameToStore;
            }

            $aboutUs->update($validatedData);

            return response()->json(['message' => 'About Us Updated Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update About Us', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy(AboutUs $aboutUs)
    {

        try {
            // Check if the category has an associated icon and delete it from storage
            if ($aboutUs->image_path) {
                // Remove the 'storage/' part from the path to get the correct path in the 'public' disk
                $imagePath = str_replace('storage/', '', $aboutUs->image_path);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            $aboutUs->delete();

            return response()->json(['message' => 'Category Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Category', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
}