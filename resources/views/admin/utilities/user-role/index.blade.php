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
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>

@endsection

@section('pageContent')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">User Role Data</h4>
                        <a href="{{ route('admin.utilities.userrole.create') }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-plus"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->first()->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.utilities.userrole.show', $user->id) }}" class="btn btn-sm btn-info">
                                                <i class="mdi mdi-information-variant"></i>
                                            </a>
                                            <a href="{{ route('admin.utilities.userrole.edit', $user->id) }}" class="btn btn-sm btn-success">
                                                <i class="mdi mdi-table-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.utilities.userrole.delete', $user->id) }}" class="btn btn-sm btn-danger btn-delete">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
