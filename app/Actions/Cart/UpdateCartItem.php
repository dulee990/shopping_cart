<?php

namespace App\Actions\Cart;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;

class UpdateCartItem
{
    public static function execute(int $userId, CartItem $cartItem, int $quantity): RedirectResponse
    {
        if ($cartItem->user_id !== $userId) {
            abort(403, 'Unauthorized cart item.');
        }

        $maxStock = $cartItem->product->stock_quantity;
        $cartItem->quantity = min($quantity, $maxStock);

        $cartItem->save();

        return back()->with('success', 'Cart updated.');
    }
}
