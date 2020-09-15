<?php

namespace Weather\Handlers;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Weather\Exceptions\ErrorOpeningFile;
use Weather\Formatters\FormatterInterface;

class FileHandler implements HandlerInterface
{
    /**
     * @var false|resource
     */
    private $handler;

    public function __construct(string $filePath)
    {
        $this->handler = fopen($filePath, 'ab');

        if ($this->handler === false) {
            throw new ErrorOpeningFile();
        }
    }

    public function write(FormatterInterface $formatter, CurrentWeather $weather): void
    {
        fwrite($this->handler, $formatter->format($weather));
    }
}
