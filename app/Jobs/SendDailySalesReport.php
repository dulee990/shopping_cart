<?php

namespace App\Jobs;

use App\Mail\DailySalesReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Reports\DailySalesReport;

class SendDailySalesReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $report = DailySalesReport::forDate(today());

        if ($report->isEmpty()) {
            return;
        }

        Mail::to(config('mail.admin_email'))
            ->send(new DailySalesReportMail($report));
    }
}

