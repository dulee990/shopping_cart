<?php

namespace App\Actions\Cart;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class AddToCart
{
    public static function execute(int $userId, int $productId, int $quantity): RedirectResponse
    {
        $product = Product::findOrFail($productId);

        $quantity = min($quantity, $product->stock_quantity);

        $item = CartItem::firstOrNew([
            'user_id'    => $userId,
            'product_id' => $product->id,
        ]);

        $item->quantity = min(
            ($item->exists ? $item->quantity : 0) + $quantity,
            $product->stock_quantity
        );

        $item->save();

        return back()->with('success', 'Added to cart.');
    }
}
