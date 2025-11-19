<?php

namespace App\Http\Controllers;


use App\Models\ParticipantBadge;
use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owned_workspaces = Workspace::with('user')
        ->latest()
        ->get();
        $unowned_workspaces = Workspace::whereExists(Task::whereExists(ParticipantBadge::with('user')))
        ->latest()
        ->get();
        return Inertia::render('Dashboard', ['owned_workspaces' => $owned_workspaces,
        'unowned_workspaces' => $unowned_workspaces]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:30',
        'user_id' => 'required|integer',
        ]);

        Workspace::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
        ]);
        WorkspaceController::index();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $input = $request->all();
        $workspace = Workspace::where([['id', '=', $input['workspace_id']], ['user_id', '=', $input['user_id']],])->get();
        $tasks = $workspace[0]->task;
        return Inertia::render('Workspace', ['workspace_data' => $workspace]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Workspace::where('id', '=', $request['workspace_id'], 'and', 'user_id', '=', ($request['user_id']+1))->delete();
    }

}
