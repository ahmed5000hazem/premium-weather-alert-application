<?php

namespace App\Jobs\Weather;

use App\Models\Location;
use App\Notifications\Weather\WeatherAlertNotification;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WeatherAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     *
     * @var WeatherService
     */
    private WeatherService $weatherService;

    /**
     * Create a new job instance.
     */
    public function __construct(private Location $location)
    {
        $this->weatherService = WeatherService::build();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weather = $this->weatherService->obtainForecastAlert(
            $this->location->name,
            Carbon::today()->toDateString(),
            Carbon::now()->addHour()->hour
        )->object();

        if (!empty($weather->alerts->alert)) {
            $alert = $weather->alerts->alert[0];
            $wa = $this->location->weatherAlerts()->create([
                'alert_type' => $alert['msgtype'],
                'message' => $alert['headline'],
                'event' => $alert['event'],
            ]);
            $this->location->user->notify(new WeatherAlertNotification($wa));
        }

    }
}
