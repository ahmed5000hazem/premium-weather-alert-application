<?php

namespace App\Jobs\Weather;

use App\Foundation\Status;
use App\Models\Location;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Location::with('user')->whereHas('user', function ($q) {
            $q->whereHas('subscriptions', function ($q) {
                $q->whereIn('stripe_status', [Status::active, Status::trialing]);
            });
        })->chunk(100, function ($locations) {
            foreach ($locations as $location) WeatherAlertJob::dispatch($location);
        });
    }
}
