<?php

namespace App\Http\Middleware;

use Closure;

class CheckProjectAttendance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current_user = \Auth::user(); // login olmush

        $project_id = $request->route()->parameter('project'); // url-den id parametrini

        $task_id = $request->route()->parameter('task'); // url-den id parametrini

        // $project_in_task_create = $request->project;

        // if(!empty($project_in_task_create))
        // {
        //     $project = \App\Project::findOrFail($project_in_task_create); // proyekti tapiriq

        //     $user_ids = $project->user_ids(); // proyekte elave olunmus userler

        //     if($project->user_id == $current_user->id) // eger user proyekte elave olunubsa ve ya user proyektin sahibirse
        //         return $next($request);
            
        //     return redirect()->route('dashboard.index');
        // }

        if($project_id) // eger proyekt id varsa
        {
            $project = \App\Project::findOrFail($project_id); // proyekti tapiriq

            $user_ids = $project->user_ids(); // proyekte elave olunmus userler

            if($project->user_id == $current_user->id || in_array($current_user->id, $user_ids)) // eger user proyekte elave olunubsa ve ya user proyektin sahibirse
                return $next($request);
            
            return redirect()->route('dashboard.index');

        } else if($task_id)
        {
            $task = \App\Task::findOrFail($task_id);

            $project = $task->project;

            $user_ids = $project->user_ids(); // proyekte elave olunmus userler

            if($project->user_id == $current_user->id || in_array($current_user->id, $user_ids)) // eger user proyekte elave olunubsa ve ya user proyektin sahibirse
                return $next($request);

            return redirect()->route('dashboard.index');

        }

        return $next($request);
    }
}
