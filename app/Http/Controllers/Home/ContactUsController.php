<?php

namespace App\Http\Controllers\Home;

use App\DataTables\Home\ContactUsDataTable;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index(ContactUsDataTable $dataTable)
    {
        return $dataTable->render('pages.home.contact_us.list');
    }

    public function show(ContactUs $contactUs)
    {
        try {
            if ($contactUs->seen === 0) {
                $contactUs->update(['seen' => 1]);
            }

            // You can return a view to display the details of the ContactUs instance
            return response()->json([ 'contactUs' => $contactUs ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update seen status', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    public function destroy(ContactUs $contactUs)
    {
        try {
            // Check if the contactUs has any associated data to delete
            // Optionally delete any related records or files

            // Delete the contactUs
            $contactUs->delete();

            return response()->json(['message' => 'ContactUs Deleted Successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete ContactUs', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }
}
