<?php

namespace App\Facades;

use App\Services\ReportExporter\ReportAuditor;
use App\Services\ReportExporter\ReportFormatter;
use App\Services\ReportExporter\ReportStorage;
use InvalidArgumentException;

class ReportExportFacade
{
    public function __construct(
        private ReportAuditor $auditor,
        private ReportFormatter $formatter,
        private ReportStorage $storage
    ){}
    public function export(array $data){
        if ($data['title'] === '') {
            throw new InvalidArgumentException('Title is required.');
        }
        if ($data['rows'] === []) {
            throw new InvalidArgumentException('Report must have at least one row.');
        }
        $format = $this->formatter->format($data['format'],[
            "title" => $data["title"],
            "rows" => $data["rows"]
        ]);
        $path = $this->storage->store("/path/to/file");
        $this->auditor->audit();

        return [
            "title"=> $data["title"],
            "format" => $data["format"],
            "path"=> $path,
            "content" => $format
        ];
    }
}