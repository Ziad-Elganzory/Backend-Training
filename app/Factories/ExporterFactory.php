<?php

namespace App\Factories;

use App\Contracts\ExporterInterface;
use App\Services\JsonExporter;
use App\Services\XmlExporter;
use App\Services\CsvExporter;

class ExporterFactory
{
    public static function make(string $format): ExporterInterface
    {
        return match ($format) {
            'json' => new JsonExporter(),
            'xml' => new XmlExporter(),
            'csv' => new CsvExporter(),
            default => throw new \InvalidArgumentException("Invalid exporter format: $format"),
        };
    }
}