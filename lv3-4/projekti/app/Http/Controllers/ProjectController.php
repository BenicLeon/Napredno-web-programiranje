<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $ledProjects = Auth::user()->ledProjects;
        $teamProjects = Auth::user()->teamProjects;
        return view('projects.index', compact('ledProjects', 'teamProjects'));
    }

    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $project = Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $project->teamMembers()->sync($request->team_members);

        return redirect()->route('projects.index');
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project); 
        $users = User::all();
        return view('projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, Project $project)
    {
        if (Auth::id() === $project->user_id) {
            $project->update($request->only('name', 'description', 'price', 'start_date', 'end_date', 'completed_tasks'));
            $project->teamMembers()->sync($request->team_members);
        } else {
            $project->update($request->only('completed_tasks'));
        }

        return redirect()->route('projects.index');
    }
}