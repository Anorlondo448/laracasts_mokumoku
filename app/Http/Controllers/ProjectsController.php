<?php

namespace App\Http\Controllers;

use App\Project;
use App\Services\Twitter;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())->take(2)->get();    // select * from projects where owner_id = xxx;
        
        // cache()->rememberForever('stats', function() {
        //     return ['lessons' => 1300, 'hours' => 50000, 'series' => 100 ];
        // });

        // $stats = cache()->get('stats');
        // dump($stats);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Project::create(
            request()->validate([
              'title' => ['required', 'min:3', 'max:25'],
              'description' => ['required', 'min:3']
            ])
            + ['owner_id' => auth()->id()]
        );

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Twitter $twitter)
    {
        // $this->authorize('update', $project);
        // abort_if(\Gate::denies('update', $project), 403);
        // abort_unless(\Gate::allows('update', $project), 403);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        // $this->autorize('update', $project);
        $project->update(request(['title', 'description']));

        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // $this->autorize('update', $project);
        $project->delete();

        return redirect('/projects');
    }
}
