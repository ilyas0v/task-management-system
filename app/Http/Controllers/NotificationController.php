<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    public function read($id)
    {
        $notification = \Auth::user()->notifications()->findOrFail($id);
        
        $notification_type = $notification->type;

        $notification->read_at = now();

        $notification->save();

        if($notification_type == 'App\Notifications\ProjectAssigned')
        {

            $project_id = $notification->data['project_id'];
            return redirect()->route('projects.show', $project_id);

        } 
        else if($notification_type == 'App\Notifications\TaskCompleted')
        {

            $task_id = $notification->data['task_id'];
            return redirect()->route('tasks.show', $task_id);
        }
    }
}
