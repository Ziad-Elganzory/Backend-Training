<?php

namespace App\Services\ReportExporter;

use Illuminate\Support\Facades\Log;

class ReportAuditor
{
    public function audit()
    {
        Log::info("Report Exported Successfully");
    }
}