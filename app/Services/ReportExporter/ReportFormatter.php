<?php

namespace App\Services\ReportExporter;

use InvalidArgumentException;

class ReportFormatter
{
    public function format(string $format, array $data)
    {
        return match($format){
            "json" => json_encode($data),
            "csv" => $this->convertToCsv($data),
            default => throw new InvalidArgumentException("Unsupported Format type")
        };
    }

    /**
     * Converts a structured data array containing a title and rows into a CSV string.
     */
    protected function convertToCsv(array $data): string
    {
        // Fallback to empty array if 'rows' is missing or not iterable
        $rows = $data['rows'] ?? [];
        $title = $data['title'] ?? 'Report';

        $stream = fopen('php://memory', 'r+');

        // 1. Write the metadata section
        fputcsv($stream, ['title:', $title]);
        fputcsv($stream, []); // Empty separator line

        // 2. Write the tabular data section
        if (is_array($rows) || $rows instanceof \Traversable) {
            foreach ($rows as $row) {
                // Ensure $row is an array before passing to fputcsv
                fputcsv($stream, (array)$row);
            }
        }

        rewind($stream);
        $csvString = stream_get_contents($stream);
        fclose($stream);

        return $csvString;
    }
}
