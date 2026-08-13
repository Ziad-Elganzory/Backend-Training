<?php

namespace App\Services\Reports;

use App\Contracts\ReportExporterInterface;

class CsvReportExporter implements ReportExporterInterface
{
    public function export(array $data): string
    {
        if (empty($data)) {
            return '';
        }

        if (!\is_array(reset($data))) {
            $data = [$data];
        }

        $stream = fopen('php://temp', 'r+');

        $firstRow = reset($data);
        if (\is_array($firstRow) && !\is_numeric(key($firstRow))) {
            fputcsv($stream, \array_keys($firstRow));
        }

        foreach ($data as $row) {
            $cleanedRow = \array_map(fn ($value) => \is_array($value) ? json_encode($value) : $value, (array)$row);
            fputcsv($stream, $cleanedRow);
        }

        rewind($stream);
        $csvContent = stream_get_contents($stream);
        fclose($stream);

        return $csvContent;
    }
}