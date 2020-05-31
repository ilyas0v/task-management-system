<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $project_id = $request->project;

        if(!is_numeric($project_id))
        {
            abort(404);
        }

        $project = \App\Project::findOrFail($project_id);

        return view('admin.tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'string|max:10000',
            'file' => 'file|nullable|max:10240|mimes:jpeg,png,doc,docx,xls,xlsx,pdf,txt',
            'deadline' => 'date|nullable',
            'project_id' => 'integer|required|exists:projects,id',
        ]);

        $t = new \App\Task();
        $t->name = $request->name;
        $t->description = $request->description;
        $t->deadline = $request->deadline;
        $t->project_id = $request->project_id;
        $t->user_id = \Auth::user()->id;

        if($request->hasFile('file'))
        {
            $t->file = $request->file->hashName();
            $request->file->storeAs('tasks', $t->file, 'public');
        }

        $t->save();

        return redirect()->route('projects.show', $t->project_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
