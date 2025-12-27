<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Actions\Checkout\CheckoutFromCart;

class CheckoutController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        try {
            CheckoutFromCart::execute($request->user());
        } catch (\DomainException $e) {
            return back()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('products')
            ->with('success', 'Order placed successfully.');
    }
}

