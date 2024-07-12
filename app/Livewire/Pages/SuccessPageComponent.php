<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SuccessPageComponent extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.success-page-component');
    }
}
