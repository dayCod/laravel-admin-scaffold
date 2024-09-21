@extends('admin.layout.app')

@section('pageTitle', 'Role Permission')

@section('pageBreadcrumb')

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Role Permission
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
                    <h4 class="card-title">Role Permission Detail</h4>
                    <p class="card-description">Role Permission Form Details</p>
                    <form class="forms-sample" method="POST" action="#">

                        <div class="form-group">
                            <label for="roleNameInput">Role Name</label>
                            <input type="text" class="form-control" id="roleNameInput" placeholder="Role Name"
                                name="role_name" value="{{ $role->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Permissions</label>
                            <div class="row">

                                @foreach ($permissions as $permission)
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input value="{{ $permission->id }}" type="checkbox" class="form-check-input" name="permissions[]" {{ in_array($permission->id, $role->permissions()->get()->pluck('id')->toArray()) ? 'checked' : '' }} disabled>
                                                {{ $permission->name }} <i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <a href="{{ route('admin.utilities.rolepermission.index') }}" class="btn btn-gradient-primary mr-2">Back</a>
                        {{-- <button class="btn btn-light">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
