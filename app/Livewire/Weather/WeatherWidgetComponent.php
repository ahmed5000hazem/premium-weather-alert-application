<?php

namespace App\Livewire\Weather;

use App\Models\Location;
use App\Services\WeatherService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class WeatherWidgetComponent extends Component
{
    /**
     *
     * @var string
     */
    public string $errorMessage = '';

    /**
     *
     * @var object
     */
    public object $weather;

    protected $listeners = ['obtainWeather'];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mount()
    {
        if (!auth()->user()->locations()->count()) $this->errorMessage = 'getting weather depends on location add location to get its weather info!';
        else $this->obtainWeather(auth()->user()->locations()->first());
    }

    public function obtainWeather(Location $location)
    {
        try {
            $weather = WeatherService::build()->obtainForecast(
                $location->name,
                Carbon::today()->toDateString(),
                Carbon::now()->addHour()->hour
            );

            $this->weather = $weather->object();
        } catch (\Throwable $th) {
            report($th);
            $this->errorMessage = 'failed to load weather data';
        }
    }

    public function render()
    {
        return view('livewire.weather.weather-widget-component');
    }
}
