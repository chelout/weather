<?php

namespace Weather\Formatters;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use SimpleXMLElement;
use Weather\Exceptions\ErrorOpeningFile;

class XmlFormatter implements FormatterInterface
{
    public function format(CurrentWeather $weather): string
    {
        $xml = new SimpleXMLElement('<weather></weather>');

        $data = [
            'date' => $weather->lastUpdate->format("Y-m-d H:i:s"),
            'wind_speed' => $weather->wind->speed->getFormatted(),
            'temperature' => $weather->temperature->getFormatted(),

            'wind_direction' => $weather->wind->direction->getFormatted(),
            'city_name' => $weather->city->name,
            'clouds' => $weather->clouds->getFormatted(),
            'humidity' => $weather->humidity->getFormatted(),
            'precipitation' => $weather->precipitation->getFormatted(),
            'pressure' => $weather->pressure->getFormatted(),
            'sun_rise' => $weather->sun->rise->format("Y-m-d H:i:s"),
            'sun_set' => $weather->sun->set->format("Y-m-d H:i:s"),
        ];

        foreach ($data as $key => $value) {
            $xml->addChild($key, $value);
        }

        $result = $xml->asXML();
        if ($result === false) {
            throw new ErrorOpeningFile();
        }

        return $result;
    }
}
