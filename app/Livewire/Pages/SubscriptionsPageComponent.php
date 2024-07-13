<?php

namespace App\Livewire\Pages;

use App\Traits\InteractsWithStripe;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Laravel\Cashier\Cashier;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy()]
class SubscriptionsPageComponent extends Component
{
    use InteractsWithStripe;

    public function getSubscriptionsProperty()
    {
        $products = $this->stripeProducts();
        return auth()->user()->subscriptions()->latest()->get()->map(function ($subscription) use ($products) {
            $product = $products->firstWhere('id', $subscription->type);
            $subscription->plan = $product['name'];
            $subscription->price = Cashier::formatAmount($product['prices']->firstWhere('id', $subscription->stripe_price)->price);
            return $subscription;
        });
    }

    /**
     *
     * @return View
     */
    public function placeholder(): View
    {
        return view('full-page-loader');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.subscriptions-page-component', [
            'subscriptions' => $this->subscriptions,
        ]);
    }
}
