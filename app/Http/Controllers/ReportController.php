<?php

namespace App\Http\Controllers;

use App\Factories\ReportExporterFactory;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(private ReportExporterFactory $factory){}
    public function export(Request $request){
        $format = $request->input('format');
        $data = $request->input('data');

        $reportExporter = $this->factory->make($format);
        $report = $reportExporter->export($data);
        return response()->json([
            'format' => $format,
            'content' => $report,
        ]);   
    }
}
