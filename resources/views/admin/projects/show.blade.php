@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">


                       <div class="row mt-4">
                           <div class="col-12">
                               <h1><img src="/storage/projects/{{ $project->icon }}" width="50px"> {{ $project->name }}</h1>
                           </div>
                       </div>


                        @foreach($project->tasks as $task)
                            <div class="row mt-4 card p-4">
                                <div class="col-12">
                                        <h3 class="mb-1">{{ $task->name }}</h3>
                                        <p>{{ $task->description }}</p>
                                        @if($task->file)
                                            <a href="/storage/tasks/{{ $task->file }}" target="_blank" ><i class="fa fa-file mt-3"> File</i></a>
                                        @endif
                                        <br>
                                        <p class="mt-2 badge badge-warning">Deadline: {{ $task->deadline->format('d M, Y') }}</p>
                                </div>
                            </div>
                        @endforeach

                       

                    </div>
                </div>
            </div>
@endsection