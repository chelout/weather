<?php

namespace Weather;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\CurrentWeather;
use GuzzleHttp\Client;
use Http\Factory\Guzzle\RequestFactory;

class App
{
    private string $type;

    private string $city;

    private string $units;

    private string $lang;

    private OpenWeatherMap $openWeatherMap;

    public function __construct(string $apiKey = null, string $city = null, string $units = null, string $lang = null)
    {
        $this->type = $_SERVER['argv'][1] ?? 'json';

        $this->city  = $city ?? $_ENV['CITY'];
        $this->units = $units ?? $_ENV['UNITS'];
        $this->lang  = $lang ?? $_ENV['LANG'];

        $this->openWeatherMap = $this->createOpenWeatherMapClient($apiKey);
    }

    public function run(): void
    {
        $this->createLogger()
             ->log($this->getWeather());
    }

    private function getWeather(): CurrentWeather
    {
        return $this->openWeatherMap->getWeather($this->city, $this->units, $this->lang);
    }

    private function createOpenWeatherMapClient(?string $apiKey): OpenWeatherMap
    {
        $httpRequestFactory = new RequestFactory();
        $httpClient         = new Client();

        return new OpenWeatherMap($apiKey ?? $_ENV['API_KEY'], $httpClient, $httpRequestFactory);
    }

    private function createLogger(): Logger
    {
        $factory = new LoggerFactory($this->type);

        return $factory->createLogger();
    }
}
