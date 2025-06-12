<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class PurchaseController extends Controller
{
    public function index()
    {
        $bundleId = $this->request->getPost('bundleId');
        $price = $this->request->getPost('price');
        $description = $this->request->getPost('description');

        // Show payment form (e.g., Stripe)
        return view('payment_form', [
            'bundleId' => $bundleId,
            'price' => $price,
            'description' => $description
        ]);
    }
}
