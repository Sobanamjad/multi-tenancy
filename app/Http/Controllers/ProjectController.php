<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::all();
        return view('project', compact('projects'));
    }

    // Store a new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Project::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Project Added Successfully');
    }

    // Edit method (optional in single-page setup, not required if inline edit)
    public function edit(Project $project)
    {
        // Agar inline edit Blade use kar rahe ho, ye method ab required nahi
        // return view('project', compact('project'));
        return redirect()->route('projects.index');
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        $project->update([
            'name' => $request->name
        ]);

        return redirect()->route('project')->with('success', 'Project Updated Successfully');
    }

    // Delete project
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('project')->with('success', 'Project Deleted Successfully');
    }
}
