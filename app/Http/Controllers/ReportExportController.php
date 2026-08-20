<?php

namespace App\Http\Controllers;

use App\Facades\ReportExportFacade;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ReportExportController extends Controller
{
    public function export(Request $request, ReportExportFacade $facade)
    {
        $data = [
            "title" => $request->string("title")->toString(),
            "format" => $request->string("format")->toString(),
            "rows" => $request->input("rows",[])
        ];
        try{
            $result = $facade->export($data);
            return response()->json($result);
        } catch(InvalidArgumentException $e){
            return response()->json([
                "error" => $e->getMessage()
            ],400);
        }
    }
}
