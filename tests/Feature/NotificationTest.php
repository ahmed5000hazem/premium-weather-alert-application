<?php

use App\Models\User;
use App\Jobs\Subscriptions\SubscriptionRemindersJob;
use App\Notifications\Subscriptions\SubscriptionExpirationNotification;
use App\Notifications\Subscriptions\TrialExpirationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use function Pest\Laravel\mock;

beforeEach(function () {
    Notification::fake();
});

it('sends trial expiration notifications', function () {

    // Create a user (or use a factory)
    $userOnTrial = User::factory()->create();

    // check the product is exists
    $product = $this->stripeProducts()->first();
    expect($product)->not->toBeNull();

    // check the prices are exist
    $prices = $product['prices'];
    $this->assertCount(2, $prices->toArray());

    $priceId = $prices->firstWhere('interval', 'year')->id;
    // Subscribe the user to the plan
    $userOnTrial->newSubscription($product['id'], $priceId)
        ->trialDays(config('cashier.default_trial_days', 7))
        ->create();

    // Assert the subscription details
    $this->assertCount(1, $userOnTrial->subscriptions); // Check if the user has exactly one subscription
    $subscription = $userOnTrial->subscriptions->first();

    expect($subscription->type)->toBe($product['id']); // Verify the type matches product ID
    expect($subscription->stripe_price)->toBe($priceId); // Verify the Stripe Price ID matches
    
    $this->assertTrue($userOnTrial->onTrial($product['id'])); // Assert user got subscription and is on trial

    $userNotOnTrial = User::factory()->create();

    $userOnTrial->subscription($product['id'])->update([
        'trial_ends_at' => now()->addDays(1),
    ]);

    // Act
    SubscriptionRemindersJob::dispatch();

    // Assert
    Notification::assertSentTo($userOnTrial, TrialExpirationNotification::class);
    Notification::assertNotSentTo($userNotOnTrial, TrialExpirationNotification::class);
});
