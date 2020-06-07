@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">


                       <div class="row mt-4 card p-4">
                           <div class="col-12">

                                <div class="d-flex justify-content-between">
                                    <h3 class="mb-1">{{ $task->name }}</h3>

                                    @if(in_array(\Auth::user()->id , $task->assigned_user_ids()))
                                        @if(!$task->completed_by_me())
                                            <a href="{{ route('tasks.complete', $task->id) }}" class="btn btn-success">Complete <i class="fa fa-check"></i></a>
                                        @else
                                            <a href="#" class="btn btn-secondary disabled">Completed <i class="fa fa-check"></i></a>
                                        @endif 
                                    @endif
                                </div>

                                <p>{{ $task->description }}</p>

                                @if($task->file)
                                    <a href="/storage/tasks/{{ $task->file }}" target="_blank" ><i class="fa fa-file mt-3"> File</i></a>
                                @endif

                                <p class="mt-4">Assigned users:  
                                    @foreach($task->assigned_users as $user)
                                        @if(in_array($user->id, $task->completed_user_ids()))
                                            @if(\Auth::user()->id == $task->user_id)
                                                <span class="badge badge-success" data-toggle="modal" data-target="#task_complete_point_modal_{{ $user->id }}">{{ $user->name }} <i class="fa fa-check"></i></span>
                                            @else
                                                <span class="badge badge-success" >{{ $user->name }} <i class="fa fa-check"></i></span>
                                            @endif
                                        @else
                                            <span class="badge badge-primary">{{ $user->name }}</span>
                                        @endif
                                    @endforeach
                                </p>
                           </div>
                       </div>


                       <div class="row mt-4 card p-4">
                           <div class="col-12">

                                <h3 class="mb-1">Comments</h3>

                                @foreach($task->comments as $comment)
                                    <div class="card  p-3 mt-3" style="background:lightgreen;color:black;">
                                        <div class="d-flex justify-content-between mb-2">
                                            <p style="font-weight:bold;">{{ $comment->user->name }}</p>
                                            <p>{{ $comment->created_at->format('d M Y') }}</p>
                                        </div>

                                        <div>
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                @endforeach


                                <div class="mt-4">
                                    <form action="{{ route('tasks.comment', $task->id) }}" method="POST">
                                        @csrf
                                        <textarea name="comment" id="" cols="30" rows="4" class="form-control" placeholder="Comment here..."></textarea>
                                        <button type="submit" class="btn btn-primary pull-right mt-1">Add comment</button>
                                    </form>
                                </div>

                           </div>
                       </div>

                       

                    </div>
                </div>
            </div>


@foreach($task->assigned_users as $user)
<!-- Modal -->
<div class="modal fade" id="task_complete_point_modal_{{ $user->id }}" role="dialog">
                <div class="modal-dialog">
                
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Point</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        @php($data = $task->point_given_to_user($user))

                        @if(isset($data->point))
                        
                            <h5>Point: {{ $data->point }}</h5>
                            <h5>Comment: {{ $data->comment }}</h5>
                        
                        @else

                        <form action="{{ route('tasks.point', $task->id) }}" id="task_user_point_form" method="POST">
                            @csrf

                            <input type="hidden" name="user_id"  value="{{ $user->id }}">

                            <label for="point" style="display:block;">
                                Point: 
                                <select class="form-control" id="point" name="point">
                                    @for($i=1;$i<=10;$i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                            </label>


                            <label for="point" style="display:block;">
                                Comment: 
                                <textarea name="comment" class='form-control'></textarea>
                            </label>

                            <input type="submit" class="btn btn-success" value="OK">
                        </form>
                        @endif
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                
                </div>
            </div>
@endforeach


@endsection


@section('javascript')
    <script>
    
        function open_task_point_modal(id)
        {
            $('#task_user_point_form input[name="user_id"]').val(id);
            $('#task_complete_point_modal').modal('show');
        }
    
    </script>
@endsection