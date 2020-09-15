<?php


namespace Weather\Formatters;


use Cmfcmf\OpenWeatherMap\CurrentWeather;

class JsonFormatter implements FormatterInterface
{
    public function format(CurrentWeather $weather): string
    {
        $data = [
            $weather->lastUpdate->format("Y-m-d H:i:s"),
            $weather->temperature->getFormatted(),
            $weather->wind->direction->getFormatted(),

            $weather->wind->speed->getFormatted(),
            $weather->city->name,
            $weather->clouds->getFormatted(),
            $weather->humidity->getFormatted(),
            $weather->precipitation->getFormatted(),
            $weather->pressure->getFormatted(),
            $weather->sun->rise->format("Y-m-d H:i:s"),
            $weather->sun->set->format("Y-m-d H:i:s"),
        ];

        return json_encode($data, JSON_THROW_ON_ERROR) . PHP_EOL;
    }
}
