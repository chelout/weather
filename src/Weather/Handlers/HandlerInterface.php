<?php

namespace Weather\Handlers;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Weather\Formatters\FormatterInterface;

interface HandlerInterface
{
    public function write(FormatterInterface $formatter, CurrentWeather $weather): void;
}
