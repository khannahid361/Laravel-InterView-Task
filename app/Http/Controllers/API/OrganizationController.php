<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    public function index()
    {
        return response()->json([
            'organizations' => Organization::all()
        ], 200);
    }

    public function show($id)
    {
        $organization = Organization::find($id);
        if (!$organization) {
            return response()->json([
                'message' => 'Organization not found'
            ], 404);
        }
        return response()->json([
            'organization' => $organization
        ], 200);
    }
    public function store(OrganizationFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $organization = Organization::create($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Organization created successfully',
                'organization' => $organization
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(OrganizationFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $organization = Organization::find($request->update_id);
            if (!$organization) {
                return response()->json([
                    'message' => 'Organization not found'
                ], 404);
            }
            $organization->update($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Organization updated successfully',
                'organization' => $organization
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
            $organization = Organization::find($request->organization_id);
            if (!$organization) {
                return response()->json([
                    'message' => 'Organization not found'
                ], 404);
            }
            $organization->delete();
            DB::commit();
            return response()->json([
                'message' => 'Organization deleted successfully',
                'organization' => $organization
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
