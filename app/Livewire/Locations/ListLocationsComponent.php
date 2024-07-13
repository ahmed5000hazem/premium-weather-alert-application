<?php

namespace App\Livewire\Locations;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListLocationsComponent extends Component
{

    /**
     *
     * @var array
     */
    protected $listeners = ['refreshLocationsComponent' => '$refresh'];

    /**
     * 
     * @return Collection
     */
    public function getLocationsProperty(): Collection
    {
        return auth()->user()->locations()->get();
    }

    /**
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.locations.list-locations-component', [
            'locations' => $this->locations,
        ]);
    }

    /**
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        auth()->user()->locations()->where('id', $id)->delete();

        $this->dispatch('$refresh');
    }

    /**
     *
     * @param string $id
     * @return void
     */
    public function obtainWeather(string $id)
    {
        $this->dispatch('obtainWeather', $id);
    }
}
