<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Cashier\SubscriptionBuilder;
use Laravel\Cashier\Cashier;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\StripeClient;

use function PHPUnit\Framework\assertTrue;

it('can subscribe with monthly subscription', function () {
    // Create a user (or use a factory)
    $user = User::factory()->create();

    // check the product is exists
    $product = $this->stripeProducts()->first();
    expect($product)->not->toBeNull();

    // check the prices are exist
    $prices = $product['prices'];
    $this->assertCount(2, $prices->toArray());

    $priceId = $prices->firstWhere('interval', 'month')->id;
    // Subscribe the user to the plan
    $user->newSubscription($product['id'], $priceId)
            ->trialDays(config('cashier.default_trial_days', 7))
            ->create();

    // Assert the subscription details
    $this->assertCount(1, $user->subscriptions); // Check if the user has exactly one subscription
    $subscription = $user->subscriptions->first();
    expect($subscription->type)->toBe($product['id']); // Verify the type matches product ID
    expect($subscription->stripe_price)->toBe($priceId); // Verify the Stripe Price ID matches

    $this->assertTrue($user->onTrial($product['id'])); // Assert user got subscription and is on trial
});

it('can subscribe with yearly subscription', function () {
    // Create a user (or use a factory)
    $user = User::factory()->create();

    // check the product is exists
    $product = $this->stripeProducts()->first();
    expect($product)->not->toBeNull();

    // check the prices are exist
    $prices = $product['prices'];
    $this->assertCount(2, $prices->toArray());

    $priceId = $prices->firstWhere('interval', 'year')->id;
    // Subscribe the user to the plan
    $user->newSubscription($product['id'], $priceId)
            ->trialDays(config('cashier.default_trial_days', 7))
            ->create();

    // Assert the subscription details
    $this->assertCount(1, $user->subscriptions); // Check if the user has exactly one subscription
    $subscription = $user->subscriptions->first();
    expect($subscription->type)->toBe($product['id']); // Verify the type matches product ID
    expect($subscription->stripe_price)->toBe($priceId); // Verify the Stripe Price ID matches
    
    $this->assertTrue($user->onTrial($product['id'])); // Assert user got subscription and is on trial
});
