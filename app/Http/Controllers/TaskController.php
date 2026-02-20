<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);

        // Create the task linked to this project
        $project->tasks()->create($validated);

        return back()->with('success', 'Task added!');
    }

    /**
     * Update the specified task (toggle completion).
     */
    public function update(Request $request, Task $task)
    {
        $task->update([
            'is_completed' => $request->has('is_completed')
        ]);

        return back()->with('success', 'Task updated!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted!');
    }
}