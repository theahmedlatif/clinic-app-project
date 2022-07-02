@extends('admin.layouts.master')
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Reports</h5>
                        <span>Visits Report</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" class="breadcrumb-item active">Reports</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" class="breadcrumb-item active">Visits Report</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="container">Query Input</h3>
            </div>
            <div class="card-body">
                <a class="btn btn-success" href="{{route('admin.visits.report')}}">Run Report Again</a>
            </div>
        </div>
        @if(isset($report))
        <div class="card">
            <table class="table table-bordered mb-5">
                <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Appointment Reference</th>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Examined By</th>
                    <th scope="col">Appointment Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($report as $key => $item)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $item->id }}</td>
                        <td>{{$item->patient != null ? $item->patient->user->first_name.' '. $item->patient->user->middle_name.' '.$item->patient->user->last_name : ''}}</td>
                        <td>{{ $item->doctor->user->first_name.' '. $item->doctor->user->middle_name.' '.$item->doctor->user->last_name}}</td>
                        <td>{{ $item->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $report->links() !!}
            </div>
        </div>
        @endif
    </div>
@endsection
