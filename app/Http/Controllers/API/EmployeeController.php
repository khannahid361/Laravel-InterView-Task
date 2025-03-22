<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeFormRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('team', 'team.organization')->get();
        return response()->json([
            'employees' => $employees
        ], 200);
    }

    public function store(EmployeeFormRequest $request)
    {
        $employee = Employee::create($request->all());
        return response()->json([
            'message' => 'Employee created successfully',
            'employee' => $employee
        ], 200);
    }

    public function update(EmployeeFormRequest $request)
    {
        $employee = Employee::find($request->update_id);
        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }
        $employee->update($request->all());
        return response()->json([
            'message' => 'Employee updated successfully',
            'employee' => $employee
        ], 200);
    }

    public function delete(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        if (!$employee) {
            return response()->json([
                'message' => 'Employee not found'
            ], 404);
        }
        $employee->delete();
        return response()->json([
            'message' => 'Employee deleted successfully',
            'employee' => $employee
        ], 200);
    }
}
