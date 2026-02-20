<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()
            ->with(['tasks' => function ($query) {
                $query->latest(); // Sorting happens here
            }])
            ->get();

        return view('dashboard', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        auth()->user()->projects()->create(['title' => $request->title]);
        return redirect()->route('dashboard')->with('success', 'Project created!');
    }

    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) { abort(403); }
        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project deleted!');
    }
}