<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PricingPageComponent extends Component
{
    /**
     *
     * @return boolean
     */
    public function getSubscribedProperty(): bool
    {
        return auth()->user()->subscribed(env('STRIPE_PRODUCT_ID'));
    }

    /**
     *
     * @return void
     */
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.pricing-page-component', [
            'subscribed' => $this->subscribed
        ]);
    }

    public function checkout($price)
    {
        return auth()
            ->user()
            ->newSubscription(env('STRIPE_PRODUCT_ID'), $price)
            ->trialDays(config('cashier.default_trial_days', 7))
            ->checkout([
                'success_url' => route('success'),
                'cancel_url' => route('pricing')
            ]);
    }
}
