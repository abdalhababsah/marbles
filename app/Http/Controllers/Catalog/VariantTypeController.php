<?php

namespace App\Http\Controllers\Catalog;
use App\DataTables\Catalog\VariantTypesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VariantType\StoreRequest;
use App\Http\Requests\VariantType\UpdateRequest;
use App\Models\VariantType;
use Illuminate\Http\JsonResponse;

class VariantTypeController extends Controller
{
    public function index(VariantTypesDataTable $dataTable)
    {
        return $dataTable->render('pages.catalog.variant_types.list');
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.catalog.variant_types.create');
    }
//C:\xampp\htdocs\stones\resources\views\pages\catalog\variant_types\create.blade.php
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            VariantType::create($validatedData);

            return response()->json(['message' => 'Variant Type Added Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add variant type', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function edit(VariantType $variantType)
    {
        return view('pages.catalog.variant_types.create', compact('variantType'));
    }

    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $variantType = VariantType::findOrFail($id);
        return view('pages.catalog.variant_types.create', compact('variantType'));
    }
    public function update(UpdateRequest $request, VariantType $variantType)
    {
        try {
            $validatedData = $request->validated();
            $variantType->update($validatedData);

            return response()->json(['message' => 'Variant Type Updated Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update variant type', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy($id)
    {
        try {
            $variantType = VariantType::findOrFail($id);
            $variantType->delete();

            return response()->json(['message' => 'Variant Type Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete variant type', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
}
