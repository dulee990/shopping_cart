<?php

namespace App\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class DailySalesReport
{
    public static function forDate($date): Collection
    {
        return DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereDate('orders.created_at', $date)
            ->select(
                'products.name',
                DB::raw('SUM(order_items.quantity) as quantity'),
                DB::raw('SUM(order_items.quantity * order_items.price) as total')
            )
            ->groupBy('products.name')
            ->get();
    }
}
