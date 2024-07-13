<?php

use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

it('can obtain forecast', function () {
    $locationName = 'Test Location';
    $date = Carbon::today()->toDateString();
    $hour = Carbon::now()->addHour()->hour;
    $mockResponse = [
        'location',
        'current',
        'forecast',
    ];

    $weatherService = WeatherService::build();
    $response = $weatherService->obtainForecast($locationName, $date, $hour);

    expect(array_keys($response->json()))->toMatchArray($mockResponse);
});

it('can obtain forecast alert', function () {
    $locationName = 'Test Location';
    $date = Carbon::today()->toDateString();
    $hour = Carbon::now()->addHour()->hour;

    $mockResponse = [
        'location',
        'current',
        'forecast',
        'alerts',
    ];

    $weatherService = WeatherService::build();
    $response = $weatherService->obtainForecastAlert($locationName, $date, $hour);

    expect(array_keys($response->json()))->toMatchArray($mockResponse);
});
