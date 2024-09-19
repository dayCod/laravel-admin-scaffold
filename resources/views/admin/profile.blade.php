@extends('admin.layout.app')

@section('pageTitle', 'Profile')

@section('pageBreadcrumb')

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Profile
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
                    <h4 class="card-title">User Profile Form</h4>
                    <p class="card-description">Fill these form to update your profile</p>
                    <form class="forms-sample" method="POST" action="{{ route('admin.profile.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nameInput">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" placeholder="Name" name="name" value="{{ $user->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" placeholder="Email" name="email" value="{{ $user->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passwordInput">Password <sup class="text-danger">(If you want to change your password)</sup></label>
                            <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
