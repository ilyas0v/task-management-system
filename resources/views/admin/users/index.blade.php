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
                                                <th>@lang('dashboard.Name')</th>
                                                <th>@lang('dashboard.Email')</th>
                                                <th>@lang('dashboard.Role')</th>
                                                <th>@lang('dashboard.Operations')</th>
                                            </tr>
                                        </thead>
                                        <tbody id="user_list_body">
                                        <button  @click="showUsers()">SHOW</button>

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


                                                <!-- <tr v-for="user in users">
                                                    <td v-html="user.id"></td>
                                                    <td v-html="user.name"></td>
                                                    <td></td>
                                                    <td></td>

                                                    <td>
                                                        <a href="" class="btn btn-secondary">Edit</a>

                                                        <form action="" method="POST" onsubmit="return confirm('Silmek istediyinizden eminsinizmi?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </form>
                                                    </td>
                                                </tr> -->
                                        
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


@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


    <script>
    
    var app = new Vue({
        el: '#user_list_body',
        data: {
            users: [
                @foreach($users as $user)
                    {
                        id    : {{ $user->id }},
                        name  : '{{ $user->name }}',
                    },
                @endforeach
            ]
        },

        mounted(){
            this.fetchUsers();
        },


        methods: {
            fetchUsers: function()
            {
                fetch('http://localhost:8000/api/users')
                .then(function(res){
                    return res.json();
                }).then(function(res){
                    this.users = res.data;
                    console.log(this.users)
                });
            },

            showUsers: function()
            {
                console.log(this.users);
            }
        }
    });
    
    </script>
@endsection