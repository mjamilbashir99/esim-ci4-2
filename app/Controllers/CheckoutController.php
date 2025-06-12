<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CheckoutController extends BaseController
{
    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/')->with('message', 'Your cart is empty.');
        }

        return view('checkout', ['cart' => $cart]);
    }
}
