<?php

namespace App\Http\Controllers;

use App\Models\ParticipantBadge;
use App\Models\Task;
use App\Models\Workspace;
use App\Models\WorkspacePermit;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $input = $request->all();
        if (Workspace::where([['id', '=', $input['workspace_id']], ['user_id', '=', $input['user_id']],])->exists()){
            $tasks = Task::with('workspace')->get();
        } elseif (WorkspacePermit::where([['user_id', $input['user_id']],['workspace_id', $input['workspace_id']]])->exists()){
            $tasks = Task::with(ParticipantBadge::with('user'))->get();
        } else {
            return Response('Access Denied', 403, ['Access Denied', 'You are not registered to this workspace.']);
        }
        return Response(['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $input = $request->all();
        if(WorkspacePermit::where([['user_id', $input['user_id']],['workspace_id', $input['workspace_id']]])->exists()
            || Workspace::where([['id', '=', $input['workspace_id']], ['user_id', '=', $input['user_id']],])->exists()
        ){
            Task::create([
            'title' => 'New Task',
            'workspace_id' => $input['workspace_id'],
            ]);
            return Response('Success', 200, ['Success', 'Task Created']);
        }
        return Response('Access Denied', 403, ['Access Denied', 'You are not registered to this workspace.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
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
    public function destroy(Task $task)
    {
        //
    }
}
