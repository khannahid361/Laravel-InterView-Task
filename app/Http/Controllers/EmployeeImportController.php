<?php

namespace App\Http\Controllers;

use App\Events\EmployeeDataImported;
use Illuminate\Http\Request;

class EmployeeImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json',
        ]);

        $json = file_get_contents($request->file('file')->getPathname());
        $employees = json_decode($json, true);

        event(new EmployeeDataImported($employees));

        return response()->json(['message' => 'Import started!'], 202);
    }
}
