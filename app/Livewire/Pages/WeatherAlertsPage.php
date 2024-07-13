<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WeatherAlertsPage extends Component
{

    public function getWeatherAlertsProperty()
    {
        return auth()->user()->weatherAlerts()->with('location')->get();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.weather-alerts-page', [
            'weatherAlerts' => $this->weatherAlerts
        ]);
    }
}
