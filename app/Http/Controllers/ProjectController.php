<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = \App\Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|max:150|string',
            'icon' => 'image|mimes:jpeg,jpg,png,svg,gif',
        ]);

        $p = new \App\Project();

        $p->name = $request->name;

        if($request->hasFile('icon'))
        {
            $p->icon = $request->icon->hashName();
            $request->icon->storeAs('projects', $p->icon, 'public');
        }

        $p->user_id = \Auth::user()->id;

        $p->save();

        \Session::flash('success_message', 'Project added');
        return redirect()->route('projects.index');
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
        $project = \App\Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
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
        $this->validate($request , [
            'name' => 'required|max:150|string',
            'icon' => 'image|mimes:jpeg,jpg,png,svg,gif',
        ]);

        $p = \App\Project::findOrFail($id);

        $p->name = $request->name;

        if($request->hasFile('icon'))
        {
            $p->icon = $request->icon->hashName();
            $request->icon->storeAs('projects', $p->icon, 'public');
        }

        $p->save();

        \Session::flash('success_message', 'Project edited');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = \App\Project::findOrFail($id);

        $project->delete();

        \Session::flash('success_message', 'Project deleted');
        return redirect()->route('projects.index');
    }




    // FETCH PROJECT USERS

    public function fetch_users($id)
    {
        $project  = \App\Project::findOrFail($id);

        $user_ids =  $project->user_ids();

        $users = \App\User::where('id', '!=' , \Auth::user()->id)->get();

        $users_all = [];

        foreach($users as $user)
        {
            $users_all[] = [
                'id' => $user->id,
                'name' => $user->name,
                'is_added' => in_array($user->id, $user_ids)
            ];
        }

        return $users_all;
    }



    // ADD, UPDATE, DELETE USERS FROM PROJECT

    public function add_users(Request $request, $id)
    {
        $this->validate($request, [
            'users.*' => 'integer|exists:users,id'
        ]);

        $project = \App\Project::findOrFail($id);

        $project->users()->sync($request->users);


        \Session::flash('success_message', 'Users updated');
        return redirect()->route('projects.index');
    }  
}
