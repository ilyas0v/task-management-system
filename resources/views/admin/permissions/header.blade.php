<div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Permissions</h2>
                                    @if(\Request::route()->getName() != 'permissions.index')
                                        <a href="{{ route('permissions.index') }}" class="btn btn-success">All</a>
                                    @endif
                                    <a href="{{ route('permissions.create') }}" class="btn btn-success">Create</a>
                                </div>
                            </div>
                            
                        </div>

@if(\Session::get('success_message'))
<div class="row mt-4">
    <div class="col-12">
        <div class="alert alert-success">{{ \Session::get('success_message') }}</div>
    </div>
</div>
@endif