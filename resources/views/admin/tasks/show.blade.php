@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">


                       <div class="row mt-4 card p-4">
                           <div class="col-12">

                                <h3 class="mb-1">{{ $task->name }}</h3>

                                <p>{{ $task->description }}</p>

                                @if($task->file)
                                    <a href="/storage/tasks/{{ $task->file }}" target="_blank" ><i class="fa fa-file mt-3"> File</i></a>
                                @endif

                                <p class="mt-4">Assigned users:  
                                    @foreach($task->assigned_users as $user)
                                        <span class="badge badge-primary">{{ $user->name }}</span>
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
@endsection