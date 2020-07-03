<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        // Jeffray ene urd argad durgui, iluu deer arga ni model deer suulgaj uguh. User model haraarai.
//        $projects = auth()->user()->projects()->orderBy('updated_at', 'desc')->get();
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
//        $project = Project::findOrFail(request('project'));

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

//        $attributes['owner_id'] = auth()->id();

        // owner_id create automatically
        $project = auth()->user()->projects()->create($attributes);


//        Project::create($attributes);  deer oruulsan bolhoor hasagdsan

        return redirect($project->path());
    }

}
