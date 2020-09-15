<?php

namespace Weather;

use Cmfcmf\OpenWeatherMap\CurrentWeather;

interface LoggerInterface
{
    public function log(CurrentWeather $weather): void;
}
