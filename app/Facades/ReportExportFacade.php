<?php

namespace App\Facades;

use App\Services\ReportExporter\ReportAuditor;
use App\Services\ReportExporter\ReportFormatter;
use App\Services\ReportExporter\ReportStorage;

class ReportExportFacade
{
    public function __construct(
        private ReportAuditor $auditor,
        private ReportFormatter $formatter,
        private ReportStorage $storage
    ){}
    public function export(array $data){
        $format = $this->formatter->format($data['format'],[
            "title" => $data["title"],
            "rows" => $data["rows"]
        ]);
        $path = $this->storage->store("/path/to/file");
        $this->auditor->audit();

        return [
            "titel"=> $data["title"],
            "format" => $data["format"],
            "path"=> $path,
            "content" => $format
        ];
    }
}