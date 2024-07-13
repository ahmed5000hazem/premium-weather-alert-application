<?php

use App\Models\WeatherAlert;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

it('can create a weather alert', function () {
    $weatherAlert = WeatherAlert::factory()->create();

    expect($weatherAlert)->toBeInstanceOf(WeatherAlert::class);
    expect(WeatherAlert::find($weatherAlert->id))->not->toBeNull();
});

it('can list weather alerts', function () {
    WeatherAlert::factory()->count(3)->create();

    $weatherAlerts = WeatherAlert::all();

    expect($weatherAlerts)->toHaveCount(3);
});

it('can associate weather alert with a location', function () {
    $location = Location::factory()->create();
    $weatherAlert = WeatherAlert::factory()->create(['location_id' => $location->id]);

    expect($weatherAlert->location_id)->toBe($location->id);
    expect($weatherAlert->location)->toBeInstanceOf(Location::class);
});
