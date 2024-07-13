<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class WeatherService
{

    /**
     *
     * @var string
     */
    protected string $base_url;

    /**
     *
     * @var string
     */
    protected string $key;

    /**
     * Undocumented function
     */
    public function __construct() {
        $this->base_url = Config::get('services.weather.base_url');
        $this->key = Config::get('services.weather.key');
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public static function build()
    {
        return new self();
    }

    /**
     * obtain forecast weather data
     *
     * @param string $q
     * @param string $date
     * @param string $hour
     * @return \Illuminate\Http\Client\Response
     */
    public function obtainForecast($q, $date, $hour)
    {
        return Http::get("{$this->base_url}/forecast.json", [
            'key' => $this->key,
            'dt' => $date,
            'q' => $q,
            'hour' => $hour
        ]);
    }

    /**
     * obtain forecast weather data
     *
     * @param string $q
     * @param string $date
     * @param string $hour
     * @return \Illuminate\Http\Client\Response
     */
    public function obtainForecastAlert($q, $date, $hour)
    {
        return Http::get("{$this->base_url}/forecast.json", [
            'key' => $this->key,
            'dt' => $date,
            'q' => $q,
            'hour' => $hour,
            'alerts' => 'yes'
        ]);
    }
}
