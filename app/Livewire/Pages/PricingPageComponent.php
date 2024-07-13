<?php

namespace App\Livewire\Pages;

use App\Traits\InteractsWithStripe;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
#[Lazy()]
class PricingPageComponent extends Component
{
    use InteractsWithStripe;

    public function getProductsProperty()
    {
        return $this->stripeProducts();
    }

    /**
     *
     * @return void
     */
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.pricing-page-component', [
            'products' => $this->products
        ]);
    }

    public function checkout($product, $price)
    {
        return auth()
            ->user()
            ->newSubscription($product, $price)
            ->trialDays(config('cashier.default_trial_days', 7))
            ->checkout([
                'success_url' => route('success'),
                'cancel_url' => route('pricing')
            ]);
    }
}
