<?php

namespace App\Livewire\Weather;

use App\Services\WeatherService;
use Carbon\Carbon;
use Livewire\Component;

class WeatherWidgetComponent extends Component
{

    /**
     *
     * @var boolean
     */
    public string $errorMessage = '';

    /**
     *
     * @var object
     */
    public object $weather;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mount()
    {
        try {
            $weather = WeatherService::build()->obtainForecast(
                'cairo',
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
