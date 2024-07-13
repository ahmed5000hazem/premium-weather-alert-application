<?php

use App\Jobs\Weather\WeatherAlertJob;
use App\Models\Location;
use App\Models\User;
use App\Notifications\Weather\WeatherAlertNotification;
use App\Services\WeatherService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

beforeEach(function () {
    Notification::fake();
});

it('can receive weather alerts', function () {
    // Create a user (or use a factory)
    $user = User::factory()->create();
    $location = Location::factory()->create(['user_id' => $user->id]);

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

    
    // dispatch alert job for specific location
    WeatherAlertJob::dispatch($location);

    $weather = WeatherService::build()->obtainForecastAlert(
        $location->name,
        Carbon::today()->toDateString(),
        Carbon::now()->addHour()->hour
    )->object();

    if (!empty($weather->alerts->alert)) {
        Notification::assertSentTo($user, WeatherAlertNotification::class);
        expect($user->weatherAlerts()->count())->toBe(1);
    }
    
});

