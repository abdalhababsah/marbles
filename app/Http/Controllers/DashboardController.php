<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ContactUs;

class DashboardController extends Controller
{
    public function index()
    {
        // Call private functions to get counts
        $productCount = $this->countAllProducts();
        $nonActiveProductCount = $this->countNonActiveProducts();
        $contactUsCount = $this->countAllContactUsMessages();
        $nonReadMessagesCount = $this->countNonReadMessages();

        // Pass counts to the view
        return view('pages/dashboards.index', compact(
            'productCount',
            'nonActiveProductCount',
            'contactUsCount',
            'nonReadMessagesCount'
        ));
    }

    // Private function to count all products
    private function countAllProducts()
    {
        return Product::count();
    }

    // Private function to count non-active products
    private function countNonActiveProducts()
    {
        return Product::where('status', 'active')->count();
    }

    // Private function to count all contact us messages
    private function countAllContactUsMessages()
    {
        return ContactUs::count();
    }

    // Private function to count non-read messages
    private function countNonReadMessages()
    {
        return ContactUs::where('seen', 0)->count();
    }
}
