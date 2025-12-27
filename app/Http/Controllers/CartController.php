<?php

namespace App\Http\Controllers;

use App\Models\CartItem;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Actions\Cart\AddToCart;
use App\Actions\Cart\RemoveCartItem;
use App\Actions\Cart\UpdateCartItem;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;

use Inertia\Response;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Cart', [
            'items' => $request->user()
                ->cartItems()
                ->with('product')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function store(AddToCartRequest $request): RedirectResponse
    {
        return AddToCart::execute(
            $request->user()->id,
            $request->validated('product_id'),
            $request->validated('quantity')
        );
    }

    public function update(UpdateCartItemRequest $request, CartItem $cartItem): RedirectResponse
    {
        return UpdateCartItem::execute(
            $request->user()->id,
            $cartItem,
            $request->validated('quantity')
        );
    }

    public function destroy(Request $request, CartItem $cartItem): RedirectResponse
    {
        return RemoveCartItem::execute(
            $request->user()->id,
            $cartItem
        );
    }
}

