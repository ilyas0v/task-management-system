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
        $projects = \Auth::user()->my_projects;

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
        $project = \App\Project::findOrFail($id);
        
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = \Auth::user()->my_projects()->findOrFail($id);

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

        $p = \Auth::user()->my_projects()->findOrFail($id);

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
        $project = \Auth::user()->my_projects()->findOrFail($id);

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

        $users_ids_added_before = $project->user_ids() ?? []; // [1,2]
        
        $project->users()->sync($request->users);
        
        $user_ids = $request->users ?? []; // [1,2,3]

        $user_ids = array_diff($user_ids, $users_ids_added_before);
        
        $users = \App\User::whereIn('id', $user_ids)->get(); // WHERE id in (1,2,3)

        foreach($users as $user)
        {
            $this->send_mail($user, $project);

            $user->notify(new \App\Notifications\ProjectAssigned($project, \Auth::user()));
        }


        \Session::flash('success_message', 'Users updated');
        return redirect()->route('projects.index');
    }  


    public function send_mail($user, $project)
    {
        $data = [ 'project' => $project, 'user' => $user ];

        \Mail::send('email.project_notification', $data, function($message) use ($user, $project){

            $message->to($user->email, $user->name)->subject
                ('Project notification');
            $message->from('laraveldev123@gmail.com','Task management system');
        });

    }
}
