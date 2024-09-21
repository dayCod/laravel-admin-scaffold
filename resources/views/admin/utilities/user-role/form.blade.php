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
                <span></span>Form <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>

@endsection

@section('pageContent')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Role Form</h4>
                    <p class="card-description">Fill these form to save your changes</p>

                    @php
                        $action = @$user
                            ? route('admin.utilities.userrole.update', @$user->id)
                            : route('admin.utilities.userrole.store');
                    @endphp

                    <form class="forms-sample" method="POST" action="{{ $action }}">
                        @csrf
                        @if (@$user)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="nameInput">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
                                placeholder="Full Name" name="name" value="{{ old('name', @$user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput"
                                placeholder="Email" name="email" value="{{ old('email', @$user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        @if (request()->routeIs('admin.utilities.userrole.create'))
                            <div class="form-group">
                                <label for="passwordInput">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput"
                                    placeholder="Password" name="password" value="{{ old('password') }}" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="rolesInput">Roles</label>
                            <select class="form-control form-control-lg" id="rolesInput" name="role_id" required>
                                <option value="" selected hidden>Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @selected(old('role_id', @$user?->roles->first()->id) == $role->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <a href="{{ route('admin.utilities.rolepermission.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
