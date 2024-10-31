<?php

namespace App\Http\Controllers\Home;

use App\DataTables\Home\HomeImagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeImagesController extends Controller
{
    public function index(HomeImagesDataTable $dataTable)
    {
        return $dataTable->render('pages.home.images.list');
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.home.images.create');
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        $validatedData = $request->validate([
            'image_title_en' => 'required|string|max:255',
            'image_title_ar' => 'required|string|max:255',
            'image_path' => 'required|image',
            'sort_order' => 'required|integer',
        ]);

        try {
            if ($request->hasFile('image_path')) {
                $filename = Str::slug(now()->toDateTimeString(), '_'); // Use current timestamp
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                // Save the file to the storage
                $path = $request->file('image_path')->storeAs('public/' . $fileNameToStore);
                // Adjust the path for the database
                $validatedData['image_path'] = 'storage/' . $fileNameToStore;
            }

            Home::create($validatedData);

            return response()->json(['message' => 'Home Image Added Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add home image', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function edit(Home $homeImage): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
//        dd($home);
        return view('pages.home.images.create', compact('homeImage'));
    }

    public function update(Request $request, Home $homeImage): \Illuminate\Http\JsonResponse
    {


//        dd($request);
        $validatedData = $request->validate([
            'image_title_en' => 'required|string|max:255',
            'image_title_ar' => 'required|string|max:255',
            'sort_order' => 'required|integer',
            'image_path' => 'image|nullable',
        ]);

        try {
            // Handle file upload if a new file is provided
            if ($request->hasFile('image_path')) {
                // Delete old image if exists
                if (!empty($homeImage->image_path)) {
                    $oldImagePath = str_replace('storage/', 'public/', $homeImage->image_path);
                    Storage::delete($oldImagePath);
                }

                // Upload new image and update image path
                $filename = Str::slug(now()->toDateTimeString(), '_');
                $extension = $request->file('image_path')->getClientOriginalExtension();
                $fileNameToStore = 'images/' . $filename . '_' . time() . '.' . $extension;
                $path = $request->file('image_path')->storeAs('public/' . $fileNameToStore);
                $validatedData['image_path'] = 'storage/' . $fileNameToStore;

            }

// Debugging - Check the final path

            $homeImage->update($validatedData);

            return response()->json(['message' => 'Home Image Updated Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update home image', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy(Home $homeImage): \Illuminate\Http\JsonResponse
    {
        try {
            // Check if the home image has an associated file and delete it from storage
            if ($homeImage->image_path) {
                // Assuming you're storing the full path in the database and need to remove the 'storage/' part
                $imagePath = str_replace('storage/', '', $homeImage->image_path);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Delete the home image entry from the database
            $homeImage->delete();

            return response()->json(['message' => 'Home Image Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Home Image', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

}
