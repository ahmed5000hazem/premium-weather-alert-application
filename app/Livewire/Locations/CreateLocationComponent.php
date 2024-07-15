<?php

namespace App\Livewire\Locations;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateLocationComponent extends Component
{

    /**
     *
     * @var array
     */
    public $location = [];

    /**
     *
     * @var array
     */
    protected $rules = [
        'location.name' => 'required',
        'location.longitude' => 'required',
        'location.latitude' => 'required',
    ];

    /**
     *
     * @var array
     */
    protected $messages = [
        'location.name.required' => 'location name is required name',
        'location.longitude.required' => 'location longitude is required',
        'location.latitude.required' => 'location latitude is required',
    ];

    /**
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.locations.create-location-component');
    }

    /**
     *
     * @return void
     */
    public function create()
    {
        $this->validate();

        $location = auth()->user()->locations()->create($this->location);

        $this->reset(['location']);

        $this->dispatch('refreshLocationsComponent');
        $this->dispatch('obtainWeather', $location->id);
    }
}
