<?php

use App\Models\Location;
use App\Models\User;

it('can create a location', function () {
    $location = Location::factory()->create();

    expect($location)->toBeInstanceOf(Location::class);
    expect(Location::find($location->id))->not->toBeNull();
});

it('can update a location', function () {
    $location = Location::factory()->create();

    $location->name = 'Updated Name';
    $location->latitude = 12.3456789;
    $location->longitude = 98.7654321;
    $location->save();

    $updatedLocation = Location::find($location->id);

    expect($updatedLocation->name)->toBe('Updated Name');
    expect($updatedLocation->latitude)->toBe(12.3456789);
    expect($updatedLocation->longitude)->toBe(98.7654321);
});

it('can delete a location', function () {
    $location = Location::factory()->create();

    $location->delete();

    expect(Location::find($location->id))->toBeNull();
});

it('can list locations', function () {
    Location::factory()->count(3)->create();

    $locations = Location::all();

    expect($locations)->toHaveCount(3);
});

it('can associate location with a user', function () {
    $user = User::factory()->create();
    $location = Location::factory()->create(['user_id' => $user->id]);

    expect($location->user_id)->toBe($user->id);
    expect($location->user)->toBeInstanceOf(User::class);
});
