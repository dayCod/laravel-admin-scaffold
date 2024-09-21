@extends('admin.layout.app')

@section('pageTitle', 'User Role')

@section('pageBreadcrumb')

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> User Role
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Details <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>

@endsection

@section('pageContent')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Roles Detail</h4>
                    <p class="card-description">User Roles Form Details</p>
                    <form class="forms-sample" method="POST" action="#">

                        <div class="form-group">
                            <label for="roleNameInput">Full Name</label>
                            <input type="text" class="form-control" id="roleNameInput" placeholder="Full Name"
                                name="role_name" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input type="text" class="form-control" id="emailInput" placeholder="Email"
                                name="role_name" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="roleNameInput">Role Name</label>
                            <input type="text" class="form-control" id="roleNameInput" placeholder="Role Name"
                                name="role_name" value="{{ $user->roles->first()->name }}" disabled>
                        </div>

                        <a href="{{ route('admin.utilities.userrole.index') }}" class="btn btn-gradient-primary mr-2">Back</a>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
