@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">


                       <div class="row mt-4">
                           <div class="col-12 d-flex align-items-center justify-content-between">
                               <h1>
                                    @if($project->icon)
                                    <img src="/storage/projects/{{ $project->icon }}" width="50px">
                                    @endif 
                                    {{ $project->name }}
                                </h1>
                                <a href="{{ route('tasks.create', ['project' => $project->id]) }}" class="btn btn-primary mt-4">Create task</a>
                           </div>
                       </div>


                        @foreach($project->tasks as $i => $task)
                            <div class="row mt-4 card p-4">
                                <div class="col-12">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="mb-1">{{ $task->name }} <span class="badge badge-primary ml-3" style="font-size:15px;">by {{ $task->owner->name }}</span></h3>
                                            <a href="{{ route('tasks.show', $task->id) }}">
                                                <i class="fa fa-eye"></i> Show
                                            </a>
                                            @if($task->belongs_to_me())
                                                <button class="btn btn-success" data-toggle="modal" data-target="#task_assign_modal_{{ $i }}">Assign to user</button>
                                            @endif
                                        </div>
                                        <p>{{ $task->description }}</p>
                                        @if($task->file)
                                            <a href="/storage/tasks/{{ $task->file }}" target="_blank" ><i class="fa fa-file mt-3"> File</i></a>
                                        @endif
                                        <br>

                                        @php
                                        
                                            $days_to_deadline = $task->deadline ? $task->deadline->diffInDays() : 0;

                                            if($days_to_deadline >= 14)
                                                $status = 'success';
                                            elseif($days_to_deadline >= 7)
                                                $status = 'warning';
                                            else
                                                $status = 'danger';

                                        @endphp 

                                        @if($task->deadline)
                                            <p class="mt-2 badge badge-{{ $status }}">Deadline: {{ $task->deadline ? $task->deadline->format('d M, Y') : '' }}</p>
                                        @endif
                                </div>
                            </div>
                        @endforeach

                       

                    </div>
                </div>
            </div>

        @foreach($project->tasks as $i => $task)
            <!-- Modal -->
            <div class="modal fade" id="task_assign_modal_{{ $i }}" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Assign users to : {{ $task->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tasks.assign', $task->id) }}" id="project_add_users_form" method="POST">
                            @csrf

                            <ul id="project_users" style="list-style: none;">
                                @foreach($project->users as $user)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="users[]" value="{{ $user->id }}" @if(in_array($user->id, $task->assigned_user_ids())) checked @endif>
                                            {{ $user->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>

                            <input type="submit" class="btn btn-success" value="SAVE">
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
                </div>
            </div>
        @endforeach
@endsection