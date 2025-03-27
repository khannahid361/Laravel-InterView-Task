<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamFormRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('organization')->get();
        return response()->json([
            'teams' => $teams
        ], 200);
    }

    public function store(TeamFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $team = Team::create($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Team created successfully',
                'team' => $team
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(TeamFormRequest $request)
    {
        DB::beginTransaction();
        try {

            $team = Team::find($request->update_id);
            if (!$team) {
                return response()->json([
                    'message' => 'Team not found'
                ], 404);
            }
            $team->update($request->all());
            DB::commit();
            return response()->json([
                'message' => 'Team updated successfully',
                'team' => $team
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
            $team = Team::find($request->team_id);
            if (!$team) {
                return response()->json([
                    'message' => 'Team not found'
                ], 404);
            }
            $team->delete();
            DB::commit();
            return response()->json([
                'message' => 'Team deleted successfully',
                'team' => $team
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
