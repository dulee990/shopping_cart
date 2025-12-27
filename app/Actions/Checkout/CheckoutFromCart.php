<?php

namespace App\Actions\Checkout;

use App\Jobs\SendLowStockNotification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckoutFromCart
{
    public static function execute(User $user): void
    {
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            throw new \DomainException('Cart is empty.');
        }

        DB::transaction(function () use ($cartItems, $user) {

            $total = 0;

            $order = Order::create([
                'user_id' => $user->id,
                'total'   => 0,
            ]);

            foreach ($cartItems as $item) {

                $product = Product::lockForUpdate()->find($item->product_id);

                if ($product->stock_quantity < $item->quantity) {
                    throw new \DomainException(
                        "Insufficient stock for {$product->name}"
                    );
                }

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'price'      => $product->price,
                    'quantity'   => $item->quantity,
                ]);

                $product->decrement('stock_quantity', $item->quantity);

                if ($product->stock_quantity <= 5) {
                    SendLowStockNotification::dispatch($product);
                }

                $total += $product->price * $item->quantity;
            }

            $order->update(['total' => $total]);
            $user->cartItems()->delete();
        });
    }
}

