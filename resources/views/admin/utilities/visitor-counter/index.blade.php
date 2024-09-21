@extends('admin.layout.app')

@section('pageTitle', 'Visitor Counter')

@section('pageBreadcrumb')

    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Visitor Counter
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
                        <h4 class="card-title">Visitor Counter Data</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User?</th>
                                    <th>Session ID</th>
                                    <th>IP Address</th>
                                    <th>Access Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitorCounters as $visitor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $visitor->user?->email ?? '-' }}</td>
                                        <td>{{ $visitor->session_id }}</td>
                                        <td>{{ $visitor->ip_address }}</td>
                                        <td>{{ $visitor->created_at }}</td>
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
