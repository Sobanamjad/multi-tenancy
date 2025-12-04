<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::all();
        return view ('project', compact ('projects'));
    }

    public function store (Request $request){
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Project::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Project Added Successfully');
    }
}
