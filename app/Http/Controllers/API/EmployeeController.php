<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeFormRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('team', 'team.organization')->paginate(50);

        return response()->json([
            'employees' => $employees
        ], 200);
    }

    public function store(EmployeeFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::create($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Employee created successfully',
                'employee' => $employee
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EmployeeFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::find($request->update_id);
            if (!$employee) {
                return response()->json([
                    'message' => 'Employee not found'
                ], 404);
            }
            $employee->update($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Employee updated successfully',
                'employee' => $employee
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $employee = Employee::find($request->employee_id);
            if (!$employee) {
                return response()->json([
                    'message' => 'Employee not found'
                ], 404);
            }
            $employee->delete();
            DB::commit();
            return response()->json([
                'message' => 'Employee deleted successfully',
                'employee' => $employee
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
