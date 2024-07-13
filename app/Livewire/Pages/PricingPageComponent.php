<?php

namespace App\Livewire\Pages;

use App\Traits\InteractsWithStripe;
use Illuminate\Contracts\View\View;
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
     * @return View
     */
    public function placeholder(): View
    {
        return view('full-page-loader');
    }

    /**
     *
     * @return View
     */
    #[Layout('layouts.app')]
    public function render(): View
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
