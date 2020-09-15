<?php

namespace Weather;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Weather\Formatters\FormatterInterface;
use Weather\Handlers\HandlerInterface;

class Logger implements LoggerInterface
{
    private HandlerInterface $handler;

    private FormatterInterface $formatter;

    public function __construct(HandlerInterface $handler, FormatterInterface $formatter)
    {
        $this->handler = $handler;
        $this->formatter = $formatter;
    }

    public function log(CurrentWeather $weather): void
    {
        $this->handler->write($this->formatter, $weather);
    }
}