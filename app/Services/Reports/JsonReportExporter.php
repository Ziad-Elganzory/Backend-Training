<?php

namespace App\Services\Reports;

use App\Contracts\ReportExporterInterface;

class JsonReportExporter implements ReportExporterInterface
{
    public function export(array $data): string
    {
        return json_encode($data);
    }
}