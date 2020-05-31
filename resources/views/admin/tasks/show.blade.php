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


                       <div class="row mt-4 card p-4">
                           <div class="col-12">
                                <h3 class="mb-1">Task name</h3>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem voluptas quae temporibus commodi dolor provident laborum voluptatem voluptates reprehenderit nihil. Eaque ea itaque eum aut, rerum iusto voluptas corporis delectus?</p>
                                <i class="fa fa-file mt-3"> File</i>
                           </div>
                       </div>

                       

                    </div>
                </div>
            </div>
@endsection