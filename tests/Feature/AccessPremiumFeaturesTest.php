<?php

use App\Models\User;
use Carbon\Carbon;

it('redirects to prices page if authenticated user is not subscribed', function () {
    // Arrange: Create an authenticated user without a subscription
    $user = User::factory()->create();
    
    // Act: Attempt to access restricted route
    $response = $this->actingAs($user)->get('/weather-alerts');
    
    // Assert: Redirect to prices page
    $response->assertRedirect('/pricing');
});

it('can access premium features on trial period', function () {
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

    // Act: Access restricted route
    $response = $this->actingAs($user)->get('/weather-alerts');
    
    // Assert: Assert response is successful
    $response->assertOk();
});

it('can access premium features when has active subscription', function () {
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
    
    // activate the subscription
    $user->subscription($product['id'])->update([
        'trial_ends_at' => Carbon::now()->subDay(),
        'stripe_status' => 'active',
    ]);

    $this->assertTrue($user->subscribed($product['id'])); // Assert user got subscription and is on trial

    // Act: Access restricted route
    $response = $this->actingAs($user)->get('/weather-alerts');
    
    // Assert: Assert response is successful
    $response->assertOk();
});
