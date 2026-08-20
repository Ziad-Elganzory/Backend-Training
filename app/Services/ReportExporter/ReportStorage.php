<?php

namespace App\Services\ReportExporter;

use Illuminate\Support\Str;

class ReportStorage
{
    public function store(string $title, string $format, string $content): string
    {
        $slug = Str::slug($title);
        return "storage/reports/{$slug}.{$format}";
    }
}