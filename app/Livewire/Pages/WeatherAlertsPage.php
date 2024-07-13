<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class WeatherAlertsPage extends Component
{
    use WithPagination;

    public function getWeatherAlertsProperty()
    {
        return auth()->user()->weatherAlerts()->with('location')->paginate(10);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.weather-alerts-page', [
            'weatherAlerts' => $this->weatherAlerts
        ]);
    }
}
