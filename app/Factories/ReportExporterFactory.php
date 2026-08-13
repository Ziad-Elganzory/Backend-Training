<?php

namespace App\Factories;

use App\Contracts\ReportExporterInterface;
use Illuminate\Contracts\Container\Container;   
use App\Services\Reports\CsvReportExporter;
use App\Services\Reports\JsonReportExporter;
use App\Services\Reports\HtmlReportExporter;

class ReportExporterFactory
{
    public function __construct(private Container $container){}
    public function make(string $format): ReportExporterInterface
    {
        $class = match ($format){
            'csv' => CsvReportExporter::class,
            'json' => JsonReportExporter::class,
            'html' => HtmlReportExporter::class,
            default => throw new \InvalidArgumentException("Invalid report format: $format"),
        };
        return $this->container->make($class);
    }
}