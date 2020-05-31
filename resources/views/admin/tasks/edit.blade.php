@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        @include('admin.projects.header')

                        <!-- FORM -->


                        <div class="row mt-4">
                            <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>User edit</strong>

                                            <div>

                                                @if($errors->any())
                                                    <ul class="alert alert-danger">
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="card-body card-block">
                                            <form action="{{ route('projects.update', $project->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                @csrf
                                                @method('PUT')

                                                
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="text-input" class=" form-control-label">Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="text-input" value="{{ $project->name }}" name="name" placeholder="" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="text-input" class=" form-control-label">Icon</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" id="text-input" name="icon" placeholder="" class="form-control">
                                                        @if($project->icon)
                                                            <img src="/storage/projects/{{ $project->icon }}" alt="">
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="row form-group">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Save
                                                    </button>
                                                    <button type="reset" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-ban"></i> Reset
                                                    </button>
                                                </div>  
                                                
    
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        

                        <!-- END FORM -->

                    </div>
                </div>
            </div>
@endsection