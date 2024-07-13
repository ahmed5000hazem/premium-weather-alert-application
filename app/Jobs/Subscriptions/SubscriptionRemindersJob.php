<?php

namespace App\Jobs\Subscriptions;

use App\Models\User;
use App\Notifications\Subscriptions\SubscriptionExpirationNotification;
use App\Notifications\Subscriptions\TrialExpirationNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscriptionRemindersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::with('subscriptions')->whereHas('subscriptions', fn ($q) => $q->onTrial())->chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->notify(new TrialExpirationNotification());
            }
        });

        User::with('subscriptions')->whereHas('subscriptions', fn ($q) => $q->onGracePeriod())->chunk(100, function ($users) {
            foreach ($users as $user) {
                $user->notify(new SubscriptionExpirationNotification());
            }
        });
    }
}
