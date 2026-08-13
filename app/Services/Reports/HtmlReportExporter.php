<?php

namespace App\Services\Reports;

use App\Contracts\ReportExporterInterface;

class HtmlReportExporter implements ReportExporterInterface
{
    public function export(array $data): string
    {
        if (empty($data)) {
            return '<p>No data available.</p>';
        }

        if (!\is_array(reset($data))) {
            $data = [$data];
        }

        $html = '<table border="1" style="border-collapse: collapse; width: 100%; text-align: left;">';

        $firstRow = reset($data);
        if (\is_array($firstRow) && !\is_numeric(key($firstRow))) {
            $html .= '<thead><tr>';
            foreach (array_keys($firstRow) as $header) {
                $html .= '<th style="padding: 8px; background-color: #f2f2f2;">' . htmlspecialchars((string)$header) . '</th>';
            }
            $html .= '</tr></thead>';
        }

        $html .= '<tbody>';
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ((array)$row as $value) {
                $html .= '<td style="padding: 8px;">';
                
                if (\is_array($value)) {
                    $html .= '<code>' . htmlspecialchars(json_encode($value)) . '</code>';
                } elseif (\is_bool($value)) {
                    $html .= $value ? '<em>true</em>' : '<em>false</em>';
                } elseif ($value === null) {
                    $html .= '<em>null</em>';
                } else {
                    $html .= htmlspecialchars((string)$value);
                }
                
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return $html;
    }
}