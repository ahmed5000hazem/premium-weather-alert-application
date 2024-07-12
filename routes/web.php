<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\SignUp;
use App\Livewire\Pages\Auth\LoginPageComponent;
use App\Livewire\Pages\Auth\SignUpPageComponent;
use App\Livewire\Pages\HomePageComponent;
use App\Livewire\Pages\PricingPageComponent;
use App\Livewire\Pages\SubscriptionsPageComponent;
use App\Livewire\Pages\SuccessPageComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', LoginPageComponent::class)->name('login');
Route::get('/sign-up', SignUpPageComponent::class)->name('signup');
Route::get('/logout', LogoutController::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', HomePageComponent::class)->name('home');
    Route::get('subscriptions', SubscriptionsPageComponent::class)->name('subscriptions');
    Route::get('pricing', PricingPageComponent::class)->name('pricing');
    Route::get('success', SuccessPageComponent::class)->name('success');
});
