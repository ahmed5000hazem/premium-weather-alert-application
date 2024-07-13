<?php

use App\Models\User;

it('can create a user', function () {
    $user = User::factory()->create();

    expect($user)->toBeInstanceOf(User::class);
    expect(User::find($user->id))->not->toBeNull();
});

it('can update a user', function () {
    $user = User::factory()->create();

    $user->name = 'Updated Name';
    $user->save();

    $updatedUser = User::find($user->id);

    expect($updatedUser->name)->toBe('Updated Name');
});

it('can delete a user', function () {
    $user = User::factory()->create();

    $user->delete();

    expect(User::find($user->id))->toBeNull();
});

it('can list users', function () {
    User::factory()->count(3)->create();

    $users = User::all();

    expect($users)->toHaveCount(3);
});