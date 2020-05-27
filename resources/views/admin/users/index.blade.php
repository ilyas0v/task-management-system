@extends('admin.layouts.default')


@section('content')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        
                        @include('admin.users.header')

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
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($users as $u)
                                                <tr>
                                                    <td>{{ $u->id }}</td>
                                                    <td>{{ $u->name }}</td>
                                                    <td>{{ $u->email }}</td>
                                                    <td>{{ $u->role ? $u->role->name : '' }}</td>

                                                    <td>
                                                        <a href="{{ route('users.edit', $u->id) }}" class="btn btn-secondary">Edit</a>

                                                        <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Silmek istediyinizden eminsinizmi?')">
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
@endsection