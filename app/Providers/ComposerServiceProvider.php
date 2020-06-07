<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('front.partials.header', 'App\Http\ViewComposers\MenuComposer');
    
        View::composer('admin.partials.header-desktop', function($view) {

            $notifications = \Auth::user()->unreadNotifications;

            $N = $this->create_notifications($notifications);

            $view->with('notifications', $N);
        });
    
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    public function create_notifications($notifications)
    {
        $N = [];

        foreach($notifications as $notification)
        {
            if($notification->type == 'App\Notifications\ProjectAssigned')
            {

                $user_id = $notification->data['owner_user_id'];
                $project_id = $notification->data['project_id'];
                
                $user    = \App\User::find($user_id);
                $project = \App\Project::find($project_id);

                if(!$user || !$project)
                    continue;
    
                $N[] = [
                        'id'         => $notification->id,
                        'message'    => $user->name . ' added you to project called "'. $project->name .'"',
                        'date'       => $notification->created_at,
                ];
            }else if($notification->type == 'App\Notifications\TaskCompleted')
            {
                $user_id = $notification->data['user_id'];
                $task_id = $notification->data['task_id'];

                $user    = \App\User::find($user_id);
                $task    = \App\Task::find($task_id);

                if(!$user || !$task)
                    continue;

                $N[] = [
                        'id'             => $notification->id,
                        'message'        => $user->name . ' completed the task : <b>' . $task->name . '</b>',
                        'date'           => $notification->created_at,
                ];
            }   
        }

        return $N;
    }
}
