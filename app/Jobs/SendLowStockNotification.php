<?php

namespace App\Jobs;

use App\Mail\LowStockMail;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLowStockNotification implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct(public Product $product) {}

    public function handle(): void
    {
        Mail::to(config('mail.admin_email'))
            ->send(new LowStockMail($this->product));
    }
}
