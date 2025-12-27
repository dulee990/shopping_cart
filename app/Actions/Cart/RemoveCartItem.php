<?php

namespace App\Actions\Cart;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;

class RemoveCartItem
{
    public static function execute(int $userId, CartItem $cartItem): RedirectResponse
    {
        if ($cartItem->user_id !== $userId) {
            abort(403, 'Unauthorized cart item.');
        }

        $cartItem->delete();

        return back()->with('success', 'Cart updated.');
    }
}
