<?php

namespace Weather\Handlers;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Weather\Exceptions\ErrorOpeningFile;
use Weather\Formatters\FormatterInterface;

class MultiFileHandler implements HandlerInterface
{
    /**
     * @var false|resource
     */
    private $handler;

    public function __construct(string $filePath)
    {
        $this->handler = fopen($this->buildFilePath($filePath), 'wb');

        if ($this->handler === false) {
            throw new ErrorOpeningFile();
        }
    }

    public function write(FormatterInterface $formatter, CurrentWeather $weather): void
    {
        fwrite($this->handler, $formatter->format($weather));
    }

    private function buildFilePath(string $filePath): string
    {
        $parts = pathinfo($filePath);

        return realpath($parts['dirname']).'/'.implode('.', [$parts['filename'], time(), $parts['extension']]);
    }
}
