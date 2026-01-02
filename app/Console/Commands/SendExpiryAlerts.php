<?php

namespace App\Console\Commands;

use App\Mail\ExpiryAlertMail;
use App\Models\Batch;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendExpiryAlerts extends Command
{
    protected $signature = 'expiry:send-alerts {--days=30}';
    protected $description = 'Send expiry alerts email to all admin users';

    public function handle(): int
    {
        $days = (int) $this->option('days');

        $today = now()->toDateString();
        $soonDate = now()->addDays($days)->toDateString();

        $expired = Batch::with('medicine')
            ->whereDate('expiry_date', '<', $today)
            ->orderBy('expiry_date')
            ->get();

        $soon = Batch::with('medicine')
            ->whereDate('expiry_date', '>=', $today)
            ->whereDate('expiry_date', '<=', $soonDate)
            ->orderBy('expiry_date')
            ->get();

        $adminEmails = User::where('role', 'admin')->pluck('email');

        $sent = 0;
        $failed = 0;

        foreach ($adminEmails as $email) {
            try {
                Mail::to($email)->send(new ExpiryAlertMail($expired, $soon, $days));
                $sent++;
            } catch (Throwable $e) {
                $failed++;
                $this->error("Failed to send to {$email}: " . $e->getMessage());
            }

            // Throttle to avoid Mailtrap rate limits (too many emails per second).
            usleep(400000); // 0.4 sec
        }

        $this->info("Expiry alerts done. Sent: {$sent}, Failed: {$failed}");

        return self::SUCCESS;
    }
}
