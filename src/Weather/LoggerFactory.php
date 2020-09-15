<?php

namespace Weather;

use Weather\Formatters\JsonFormatter;
use Weather\Formatters\XmlFormatter;
use Weather\Handlers\FileHandler;
use Weather\Handlers\MultiFileHandler;

class LoggerFactory
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function createLogger(): Logger
    {
        switch ($this->type) {
            case 'xml':
                $handler   = new MultiFileHandler(__DIR__.'/../../logs/xml.log');
                $formatter = new XmlFormatter();
                break;
            case 'json':
            default:
                $handler   = new FileHandler(__DIR__.'/../../logs/json.log');
                $formatter = new JsonFormatter();
        }

        return new Logger($handler, $formatter);
    }
}
