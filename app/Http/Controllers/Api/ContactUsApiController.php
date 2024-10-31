<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Response;

class ContactUsApiController extends Controller
{
    public function store(StoreContactUsRequest $request)
    {
        try {
            ContactUs::create($request->validated());
            return response()->json(['message' => 'Contact us record created successfully.'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create contact us record.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
