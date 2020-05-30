@extends('admin.layouts.default')


@section('content')

<style>
.modal-backdrop.show {
    z-index: 10 !important;
}
</style>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        
                        @include('admin.projects.header')

                        <!-- TABLE -->

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Icon</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($projects as $p)
                                                <tr>
                                                    <td>{{ $p->id }}</td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>
                                                        @if($p->icon)
                                                            <img src="/storage/projects/{{ $p->icon }}" alt="">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="open_users_modal({{ $p->id }})">Users ({{ count($p->users) }})</button>
                                                        <a href="{{ route('projects.edit', $p->id) }}" class="btn btn-secondary">Edit</a>

                                                        <form action="{{ route('projects.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Silmek istediyinizden eminsinizmi?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

                        <!-- END TABLE -->

                    </div>
                </div>
            </div>




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Users</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form action="" id="project_add_users_form" method="POST">
                @csrf

                <ul id="project_users" style="list-style: none;">

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


<script>
    function open_users_modal(project_id)
    {
        $('#project_add_users_form').attr('action', `/admin/projects/${project_id}/add_users`);

        var project_users_list = $('#project_users');

        project_users_list.html('');

        $.ajax({
            url : `/admin/projects/${project_id}/fetch_users`,
            method : 'GET',
            success : function(res){
                
                res.map(function(user){
                    
                    project_users_list.append(`
                        <li>
                            <label>
                                <input type="checkbox" name="users[]" value="${user.id}"  ${ user.is_added ? 'checked' : ''}>
                                ${user.name}
                            </label>
                        </li>
                    `);

                });
            },
            error : function(err){
                console.log(err);
            }
        })
    }
</script>
@endsection