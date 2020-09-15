<?php

namespace Weather\Formatters;

use Cmfcmf\OpenWeatherMap\CurrentWeather;

interface FormatterInterface
{
    public function format(CurrentWeather $weather): string;
}
