<?php

namespace App\Contracts;

interface ReportExporterInterface
{
    public function export(array $data): string;
}