<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamFormRequest;
use App\Models\Team;
use Illuminate\Http\Request;

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
        $team = Team::create($request->all());
        return response()->json([
            'message' => 'Team created successfully',
            'team' => $team
        ], 200);
    }

    public function update(TeamFormRequest $request)
    {
        $team = Team::find($request->update_id);
        if (!$team) {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }
        $team->update($request->all());
        return response()->json([
            'message' => 'Team updated successfully',
            'team' => $team
        ], 200);
    }

    public function delete(Request $request)
    {
        $team = Team::find($request->team_id);
        if (!$team) {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }
        $team->delete();
        return response()->json([
            'message' => 'Team deleted successfully',
            'team' => $team
        ], 200);
    }
}
