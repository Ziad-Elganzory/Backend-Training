<?php

namespace App\Services;

use App\Contracts\ExporterInterface;

class JsonExporter implements ExporterInterface
{
    public function export(array $data): string
    {
        return json_encode($data);
    }
}