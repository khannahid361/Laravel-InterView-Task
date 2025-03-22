<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        return response()->json([
            'organizations' => Organization::all()
        ], 200);
    }

    public function store(OrganizationFormRequest $request)
    {
        $organization = Organization::create($request->all());  

        return response()->json([
            'message' => 'Organization created successfully',
            'organization' => $organization
        ], 200);
    }

    public function update(OrganizationFormRequest $request)
    {
        $organization = Organization::find($request->update_id);
        if(!$organization) {
            return response()->json([
                'message' => 'Organization not found'
            ], 404);
        }
        $organization->update($request->all());  
        return response()->json([
            'message' => 'Organization updated successfully',
            'organization' => $organization
        ], 200);
    }

    public function delete(Request $request)
    {
        $organization = Organization::find($request->organization_id);
        if(!$organization) {
            return response()->json([
                'message' => 'Organization not found'
            ], 404);
        }
        $organization->delete();
        return response()->json([
            'message' => 'Organization deleted successfully',
            'organization' => $organization
        ], 200);
    }
}
